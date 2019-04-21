<?php

namespace App\Http\Controllers;

use App\Validaciones\ValidacionesSlider;
use Illuminate\Http\Request;
use App\Modelos\Imagen;
use App\Modelos\Slider;


class SliderController extends Controller
{
    public function crearSlider(Request $request){
        $data = $request->all();
        $validator = ValidacionesSlider::crearSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $slider = new Slider();
        $slider->fill($data);
        return ($slider->save()) ? response()->json(['data' => $slider->id], 200) :
            response()->json(['data' => false, 'errors' => $slider->getErrors()], 404);

    }

    public function agregarImagenSlider(Request $request){

        $data = $request->all();
        $validator = ValidacionesSlider::agregarImagenSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $foto = new Imagen();
        $file = $request->file('foto');

        $nombre = str_random() . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path()."\\app\\public\\imagenesSlider\\".$data['slider_id']."\\",$nombre);
         $data['foto']=url("\\storage\\"."\\imagenesSlider\\".$data['slider_id']."\\".((file_exists("storage\\imagenesSlider\\".$data['slider_id']."\\".$nombre)==false)?"unknownproductora.jpg":$nombre));
        $foto->fill($data);
        $status=$foto->save();
        if($status){

            return response()->json(['data' => $foto->id], 200);
        }
        else
        {
            return response()->json(['data' => false, 'errors' => $foto->getErrors()], 404);
        }
    }

    public function agregarInformacionImagenSlider(Request $request,$fotoId){

        $request->merge(['id' => $fotoId]);
        $data = $request->all();

        $validator = ValidacionesSlider::agregarInformacionImagenSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        Imagen::where('id',$fotoId)
             ->update($data);

        return Response(['data' => true], 200);

    }

    public function getImagenSlider(Request $request,$fotoId){

        $validator = ValidacionesSlider::fotoExistsValidacion(['id'=>$fotoId]);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail'], 404);
        }
        $foto=Imagen::where('id',$fotoId)->first();

        return response()->json(['url' => $foto], 200);


    }

    public function showSlider(Request $request,$slider_id){

        $validator = ValidacionesSlider::sliderExistsValidacion(['id'=>$slider_id]);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail'], 404);
        }
        $slider= Slider::where('id',$slider_id)->first();

        $fotos= Imagen::where('slider_id',$slider_id)->get();
        foreach ($fotos as $foto){

        }
        $slider['fotos']=$fotos;

        return response()->json(['data' => $slider, 200]);
    }

    public function showAllSlider(){

        $sliders=Slider::get();

        foreach($sliders as $slider){
            $slider_un=$slider;
            $slider_un['fotos']=Imagen::where('slider_id',$slider->id)->get();
            $data[]=$slider_un;
        }

        return response()->json(['data' => $data], 200);

    }

    public function eliminarSlider(Request $request,$slider_id)
    {
        $validator = ValidacionesSlider::sliderExistsValidacion(['id'=>$slider_id]);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        return (Slider::where('id', $slider_id)->delete()) ?
            response()->json(['data' => true], 200) :
            response()->json(['data' => false], 404);
    }

}
