<?php

namespace App\Http\Controllers;

use App\Modelos\Slider;
use App\Modelos\TemplateFoto;
use Illuminate\Http\Request;
use App\Validaciones\ValidacionesTemplateSlider;
use App\Modelos\TemplateSlider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class templateSliderController extends Controller
{
    public function crearTemplateSlider(Request $request){
        $data = $request->all();
        $validator = ValidacionesTemplateSlider::crearTemplateSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $slider = new TemplateSlider();
        $slider->fill($data);
        return ($slider->save()) ? response()->json(['data' => $slider->id], 200) :
            response()->json(['data' => false, 'errors' => $slider->getErrors()], 404);

    }

    public function agregarTemplateFotoSlider(Request $request){

        $data = $request->all();
        $validator = ValidacionesTemplateSlider::agregarFotoTemplateSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $foto = new TemplateFoto();
        $file = $request->file('foto');

        $nombre = str_random() . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path()."\\app\\public\\imagenesTemplateSlider\\".$data['templateSlider_id']."\\",$nombre);
        $data['foto']=url("\\storage\\"."\\imagenesTemplateSlider\\".$data['templateSlider_id']."\\".((file_exists("storage\\imagenesSlider\\".$data['templateSlider_id']."\\".$nombre)==false)?"unknownproductora.jpg":$nombre));
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

    public function  agregarInformacionTemplateFotoSlider(Request $request,$fotoId){

        $request->merge(['id' => $fotoId]);
        $data = $request->all();

        $validator = ValidacionesTemplateSlider::agregarInformacionFotoTemplateSliderValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        TemplateFoto::where('id',$fotoId)
            ->update($data);

        return Response(['data' => true], 200);

    }

    public function getFotoTemplateSlider(Request $request,$fotoId){

        $validator = ValidacionesTemplateSlider::TemplatefotoExistsValidacion(['id'=>$fotoId]);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail'], 404);
        }
        $foto=TemplateFoto::where('id',$fotoId)->first();

        return response()->json(['url' => $foto], 200);


    }

    public function showTemplateSlider(Request $request,$slider_id){

        $validator = ValidacionesTemplateSlider::TemplateSliderExistsValidacion(['id'=>$slider_id]);

        if ($validator->fails()) {
            return response()->json(['data' => 'fail'], 404);
        }
        $slider= TemplateSlider::where('id',$slider_id)->first();

        $fotos= TemplateFoto::where('templateSlider_id',$slider_id)->get();

        $slider['fotos']=$fotos;

        return response()->json(['data' => $slider, 200]);
    }

    public function showAllTemplateSlider(){

        $sliders=TemplateSlider::get();

        foreach($sliders as $slider){
            $slider_un=$slider;
            $slider_un['fotos']=TemplateFoto::where('templateSlider_id',$slider->id)->get();
            $data[]=$slider_un;
        }

        return response()->json(['data' => $data], 200);

    }

    public function eliminarTemplateSlider(Request $request,$slider_id)
    {
        $validator = ValidacionesTemplateSlider::TemplateSliderExistsValidacion(['id'=>$slider_id]);
        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }

        return (TemplateSlider::where('id', $slider_id)->delete()) ?
            response()->json(['data' => true], 200) :
            response()->json(['data' => false], 404);
    }

    public function crearSliderDeTemplateSlider(Request $request,$slider_id){

        $request->merge(['id' => $slider_id]);
        $data = $request->all();
        $validator = ValidacionesTemplateSlider::TemplateSliderExistsValidacion($data);

        if ($validator->fails()) {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $Tslider = TemplateSlider::where('id',$data['id'])->first();

        if ($Tslider['status']=='inactivo') {
            return response()->json(['data' => false, 'error' =>
                $validator->messages()->first()], 404);
        }
        $slider = new Slider([
                                'propietario_id'=> $Tslider['usuario_id'],
                                'tipo'          => $Tslider['tipo'],
                                'total'         => $Tslider['total'],
                                'efecto'        => $Tslider['efecto'],
                                'status'        => $Tslider['status']
                             ]);

        return ($slider->save()) ? response()->json(['data' => $slider->id], 200) :
            response()->json(['data' => false, 'errors' => $slider->getErrors()], 404);


    }


}
