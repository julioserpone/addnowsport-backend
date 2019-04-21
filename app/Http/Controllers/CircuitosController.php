<?php

namespace App\Http\Controllers;

use App\Modelos\Circuito;
use App\Modelos\Usuario;
use App\Validaciones\ValidacionesCircuitos;
use Illuminate\Http\Request;

class CircuitosController extends Controller
{

    public function crearCircuito(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCircuitos::crearValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $circuito = new Circuito();
            $circuito->fill($data);

            if ($circuito->save())
            {
                return response()->json(['data' => $circuito->id], 200);
            }

            return response()->json(['data' => false, 'errors' => $circuito->getErrors()], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarCircuito(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge([ 'id' => $id, 'productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCircuitos::mostrarValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $circuito = Circuito::whereId($id)->first();
            if(is_null($circuito))
            {
                return response()->json(['data' => false, 'errors' => 'No existe un circuito asociado'], 404);
            }

            return response()->json(['data' => $circuito], 200);

        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function mostrarCircuitos(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCircuitos::mostrarCircuitosValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            $circuitos = Circuito::where('productora_id', $data['productora_id'])->get();

            if (is_null($circuitos))
            {
                return response()->json(['data' => false, 'errors' => 'No existen circuitos'], 404);
            }

            return response()->json(['data' => $circuitos], 200);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function actualizar(Request $request)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge(['productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCircuitos::actualizarValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['status' => 'fail', 'errors' =>
                    $validator->messages()->first()], 404);
            }

            try
            {
                Circuito::where('id', $data['id'])->where('productora_id', $data['productora_id'])->update(['nombre' => $data['nombre'], 'puntos' => $data['puntos']]);
                return response()->json(['data' => true], 200);
            }catch (Exception $e)
            {
                return response()->json(['data' => false, 'errors' => 'NO se puedo lleva a cabo la actualizacion: ' . $e], 404);
            }
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }

    public function eliminar(Request $request, $id)
    {
        $usuario = Usuario::isAuthenticate();
        if ($usuario && ($usuario->productora_activa != null))
        {
            $request->merge([ 'id' => $id, 'productora_id' => $usuario->productora_activa]);
            $data = $request->all();
            $validator = ValidacionesCircuitos::eliminarValidacion($data);

            if ($validator->fails())
            {
                return response()->json(['data' => false, 'errors' =>
                    $validator->messages()->first()], 404);
            }

            Circuito::whereId($data['id'])->where('productora_id', $data['productora_id'])->delete();
            return response()->json(['data' => true], 404);
        }

        return response()->json(['errors' => trans('generals.insufficient_role')], 404);
    }
}
