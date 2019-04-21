<?php

namespace App\Http\Controllers;

use App\Modelos\DatosBancarios;
use App\Modelos\DatosBancariosProductoras;
use App\Modelos\Foto;
use App\Modelos\Premio;
use App\Modelos\Usuario;
use App\Modelos\Venta;
use App\Modelos\Distancia;
use App\Modelos\Competencia;
use App\Modelos\Fecha;
use App\Modelos\Operacion;
use App\Modelos\Productora;
use App\Modelos\DatosBanco as CuentaBancaria;
use App\Validaciones\ValidacionesProductoras;
use App\Validaciones\ValidacionesVentas;
use App\Validaciones\ValidacionesDatosBancarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductoraController extends Controller
{

    public function logo(Request $request)
    {   //Respuesta default
        $data = array('success' => false);

        //obtenemos el campo file definido en el formulario

        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = str_random() . '.' . $file->getClientOriginalExtension();


        //indicamos que queremos guardar un nuevo archivo en el disco local/tmp
        if (Storage::disk('local')->put($nombre, File::get($file))):
            $data = array(
                'success' => true,
                'file_name' => $nombre,
                'message' => 'Archivo agregado exitosamente',
            );
            return Response($data, 200);
        endif;
    }

    public function mover(Request $request, $id)
    {
        $file_name = $request->input('file_name');

        // Meto archivo en directorio.
        Storage::disk('logos_productoras')->put(
            $file_name, Storage::disk('tmp')->get($file_name)
        );

        // Comprueba si se copio
        if (!Storage::disk('logos_productoras')->exists($file_name)) {
            return response()->json(['status' => 'fail', 'errors' => ['code' => 404, 'message' => 'Imagen no puedo ser guardada.']], 404);
        }

        // Compruebo Cliente
        $cliente = Persona::find($id);
        if (!$cliente) {
            return response()->json(['status' => 'fail', 'errors' => ['code' => 404, 'message' => 'No se encuentra un Cliente con ese c�digo.']], 404);
        }

        //        Storage::disk('tmp')->delete($file_name);
        $cliente->image_path = $file_name;
        $cliente->save();


        $response = ['status' => 'ok', 'data' => $cliente];
        $headers = array(
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        //return response()->json([$response, 200, $headers, JSON_UNESCAPED_UNICODE]);
    }

    public function getPorcentaje(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null) {

            $data = ['productora_id' => $usuario->productora_activa];
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productora = Productora::whereId($data['productora_id'])->first();
            $datosBancariosProductora = DatosBancariosProductoras::select('datosbancarios_id')->where('productora_id', $data['productora_id'])->get()->toArray();
            $datosBancarios = DatosBancarios::whereIn('id', $datosBancariosProductora)->where('status', 'activo')->first();

            $campos = $productora->importantes() + $datosBancarios->importantes();
            $total = (100 / 13);//se divide por 13 ya que esa es la cantidad importantes de campos para considerar un perfil completo



            return response()->json(['data' => $campos * $total], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    /**
     * @api {post} /api/v1/productora/{productora_id}/image
     * Actualiza la imagen asociada a la productora
     * @apiVersion 1.0.0
     * @apiName CambiarImagenProductora
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora
     * @apiParam {file} file               Imagen perfil productora
     * @apiSuccess (200) {Boolean} true     Imagen actualizada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Delete
     *     {
     *        "data": false
     *     }
     */

    public function cambiarImagenProductora(Request $request, $productora_id)
    {

        $data = $request->all();

        $validator = ValidacionesProductoras::cambiarImagenProductoraValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail', 'error' =>
                $validator->messages()->first()], 404);
        }

        $file = $request->file('imagen');

        $nombre = str_random() . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path() . "\\app\\public\\imagenesProductora\\", $nombre);

        $data = array(
            'data' => true,
        );

        Productora::where('id', $productora_id)
            ->update(['avatar' => $nombre]);

        return Response($data, 200);

    }

    /**
     * @api {get} /api/v1/productora/{productora_id}/image
     * Retorna la imagen de la productora
     * @apiVersion 1.0.0
     * @apiName getProductoraImagen
     * @apiGroup Productora
     * @apiParam {Integer} productora_id    Id Productora
     * @apiSuccess (200) {Boolean} true     Imagen
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "imagen.jpeg"
     *     }
     *      OR
     *      HTTP/1.1 200 OK
     *     {
     *       "unknown-productora.jpeg"
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Delete
     *     {
     *        "data": false
     *     }
     */

    public function getProductoraImagen(Request $request, $productora_id)
    {

        $request->merge(['productora_id' => $productora_id]);

        $data = $request->all();

        $validator = ValidacionesProductoras::getProductoraImagenValidacion(['productora_id' => $productora_id]);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail'], 404);
        }
        $name = productora::where('id', $productora_id)->first()['avatar'];

        $photoFileName = "storage\\imagenesProductora\\" . ((file_exists("storage\\imagenesProductora\\" . $name) == false) ? "unknown-productora.jpg" : $name);

        return response()->json(['url' => array(url($photoFileName))], 200);

    }

    /**
     * @api {post} /api/v1/productora/{productora_id} actualizar registro de Productora
     * @apiVersion 1.0.0
     * @apiName actualizarProductora
     * @apiGroup Productora
     * @apiHeader {String} Content-Type Tipo de contenido para el request enviado
     * @apiHeaderExample {json} Header-Example:
     * {
     *  "Content-Type": "application/json"
     * }
     * @apiParam {Integer} productora_id   id de la productora que se actualizara
     * @apiParam {Integer} usuario_id   id del usuario asociado a la productora
     * @apiParam {String} nombre    Nombre de prodcutora
     * @apiParam {String} razon     Razon social de la productora
     * @apiParam {String} cuit      CUIT asociado a la prodcutora
     * @apiParam {String} pais      Pais de la prodcutora
     * @apiParam {String} ciudad    provincia de la productora
     * @apiParam {String} direccion    direccion de donde esta ubicada la productora
     * @apiParam {String} correo    Email asociado a la productora
     * @apiParam {String} prefijo    Prefijo asociado al telefono de la productora
     * @apiParam {String} telefono    Telefono de la productora
     * @apiParam {String} web    pagina web oficial de la productora
     * @apiParam {String} descripcion    Descripcion sobre la productora
     * @apiParam {String} facebook    Redsocial de facebook asociada a la productora.
     * @apiParam {String} twitter    Redsocial de twiiter asociada a la productora.
     * @apiParam {String} google    Redsocial de google asociada a la productora.
     * @apiParamExample {json} Request-Example:
     * {
     *   'productora_id'    : '1',
     *   'usuario_id'    : '1',
     *   'nombre'        : "Ejemplo"
     *   'razon'         : 'RazonEjemplo',
     *   'cuit'          :'5148745',
     *   'pais'          :'Chile',
     *   'provincia'     :'Santiago',
     *   'direccion'     :'Ejemplo de direccion',
     *   'email'         :'productoraemail@gmail.com',
     *   'prefijo'       :'0534',
     *   'telefono'      :'58789587',
     *   'website'       :'productora.com',
     *   'descripcion'   :'la mejor productora',
     *   'facebook'      :'Ejemplo',
     *   'twitter'       :'Ejemplo',
     *   'google'        :'Ejemplo'
     * }
     * @apiSuccess (200) {Integer} id   Id Disciplina creada
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "data": true
     *     }
     *
     * @apiError {json}  json   Retorna un json de estructura <code>{ "errors": false }</code>
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 ProductoraNotSave
     *     {
     *        "data":   false
     *     }
     */
    public function actualizarProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {

            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesProductoras::actualizarProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productora = Productora::where('id', $data['productora_id'])->first();

            if (!is_null($productora) || !empty($productora)) {
                $productora->where('id', $data['productora_id'])
                    ->update(array(
                        'nombre' => $data['nombre'],
                        'razon_social' => $data['razon'],
                        'cuit' => $data['cuit'],
                        'pais' => $data['pais'],
                        'ciudad' => $data['provincia'],
                        'direccion' => $data['direccion'],
                        'correo' => $data['email'],
                        'telefono' => $data['prefijo'] . "-" . $data['telefono'],
                        'web' => $data['website'],
                        'descripcion' => $data['descripcion'],
                        'facebook' => $data['facebook'],
                        'twitter' => $data['twitter'],
                        'google' => $data['google'],
                        'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
                    ));

                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false], 404);

        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);

    }

    public function mostrarDatosProductora(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario &&  $usuario->productora_activa != null)
        {
            return response()->json(['data' => Productora::whereId($usuario->productora_activa)->first()], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function showAllVentas(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesProductoras::existsProductoraValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            return response()->json(['data' => Venta::where('productora_id', $data['productora_id'])->get()], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function showVenta(Request $request,$venta_id){
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['id' => $venta_id]);
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesVentas::existsVentasValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $venta = Venta::where('id', $venta_id)->where('productora_id', $data['productora_id'])->first();

            if (!is_null($venta) || !empty($venta)) {

                return response()->json(['data' => $venta], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        }
        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function showMediosDePago()
    {
        return response()->json(['data' => Operacion::select('tipo')->distinct()->get()], 200);
    }

    public function crearDatosBancarios(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesDatosBancarios::crearValidacion($data);

            if ($validator->fails()) {
                return response()->json(['error' =>
                    $validator->messages()->first()], 404);
            }

            $datosBancarios = new DatosBancarios([
                'banco_id' => $data['banco_id'],
                'tipo_cuenta' => $data['tipo_cuenta'],
                'titular' => $data['titular'],
                'rut' => $data['rut'],
                'nro_cuenta' => $data['nro_cuenta'],
                'correo' => $data['correo'],
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ]);

            if ($datosBancarios->save()) {
                $datosBancariosProductoras = new DatosBancariosProductoras([
                    'productora_id' => $data['productora_id'],
                    'datosbancarios_id' => $datosBancarios->id,
                    'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
                ]);

                $productora = Productora::where('id', $usuario->productora_activa)->first();
                if($productora['pin_retiro'] == null)
                {
                    Productora::where('id', $usuario->productora_activa)->update(['pin_retiro' => hash(env('ENCRYPTION_ALGORITHM'), $data['pin'])]);
                }

                return ($datosBancariosProductoras->save()) ? response()->json(['id' => $datosBancariosProductoras->id], 200) :
                    response()->json(['errors' => $datosBancariosProductoras->getErrors()], 404);
            }

            return (response()->json(['errors' => $datosBancarios->getErrors()], 404));
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function actualizarDatosBancarios(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null) {

            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesDatosBancarios::actualizarValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $datosBancariosProductoras = DatosBancariosProductoras::where('productora_id', $data['productora_id'])->first();

            if (!is_null($datosBancariosProductoras) || !empty($datosBancariosProductoras)) {
                $datosbancarios = DatosBancarios::where('id', $datosBancariosProductoras['datosbancarios_id'])->first();
                $datosbancarios->where('id', $datosBancariosProductoras['datosbancarios_id'])
                    ->update(array(
                        'banco_id' => $data['banco_id'],
                        'titular' => $data['titular'],
                        'rut' => $data['rut'],
                        'nro_cuenta' => $data['nro_cuenta'],
                        'correo' => $data['correo'],
                        'tipo_cuenta' => $data['tipo_cuenta'],
                        'updated_at' => \DB::raw('CURRENT_TIMESTAMP'),
                    ));
                return response()->json(['data' => true], 200);
            } else {
                return response()->json(['data' => false], 404);
            }
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }

    }

    public function mostrarDatosBancarios(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null)
        {
            $datosBancariosProductoras = DatosBancariosProductoras::where('productora_id', $usuario->productora_activa)->with('datosBancarios')->get();
            return response()->json(['data' => $datosBancariosProductoras], 200);
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    public function eliminarDatosBancarios(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null) {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesDatosBancarios::eliminarValidacion($data);

            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $datosBancariosProductoras = DatosBancariosProductoras::whereId($data['id'])->where('productora_id', $usuario->productora_activa)->delete();
            if($datosBancariosProductoras == 1)
            {
                return response()->json(['data' => true], 200);
            }
            return response()->json(['data' => false, 'errors' => 'no tiene cuentas para eliminar'], 200);
        }
        else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
    }

    public function actualizarPin(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && $usuario->productora_activa != null) {

            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesDatosBancarios::actualizarPinValidacion($data);

            if ($validator->fails()) {
                return response()->json(['data' => false, 'error' =>
                    $validator->messages()->first()], 404);
            }

            $productora = Productora::where('id', $usuario->productora_activa)->first();
            if($productora->pin_retiro == hash(env('ENCRYPTION_ALGORITHM'), $data['pin']))
            {
                Productora::where('id', $usuario->productora_activa)
                    ->update(['pin_retiro' => hash(env('ENCRYPTION_ALGORITHM'), $data['pin_nuevo'])]);
                return response()->json(['data' => true], 200);
            }

            return response()->json(['data' => false], 200);
        }

         return response()->json(['data' => false, 'errors' => trans('generals.insufficient_role')], 404);
    }

    public function showDistancias(Request $request, $productora_id)
    {
        $request->merge(['productora_id' => $productora_id]);
        $data = $request->all();
        $validator = ValidacionesProductoras::existsProductoraValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        return response()->json(['data' => Distancia::where('productora_id', $productora_id)->get()], 200);

    }

    public function showCompetencias(Request $request, $productora_id)
    {
        $request->merge(['productora_id' => $productora_id]);
        $data = $request->all();
        $validator = ValidacionesProductoras::existsProductoraValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        return response()->json(['data' => Competencia::where('productora_id',$productora_id)->get()], 200);

    }



}