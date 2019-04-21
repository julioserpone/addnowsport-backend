<?php

namespace App\Http\Controllers;

use App\Modelos\Distancia;
use App\Modelos\Fecha;
use Illuminate\Http\Request;
use App\Modelos\Venta;
use App\Modelos\Operacion;
use App\Modelos\Productora;
use App\Validaciones\ValidacionesVentas;
class VentasController extends Controller
{
    public function showAllVentas(){

        return response()->json(['data' => Venta::get()], 200);

    }

    public function showVenta(Request $request,$venta_id){
        $request->merge(['id' => $venta_id]);
        $data = $request->all();
        $validator = ValidacionesVentas::existsVentasValidacion($data);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        return response()->json(['data' => Venta::where('id', $data['id'])->get()], 200);
    }

    public function showMediosDePago(){

        return response()->json(['data' => Operacion::select('tipo')->distinct()->get()], 200);

    }

    public function showDistancias(){

        return response()->json(['data' => Distancia::get()], 200);

    }

    public function showFechas(){

        return response()->json(['data' => Fecha::get()], 200);

    }

    public function showProductoras(){

        return response()->json(['data' => Productora::get()], 200);

    }


}
