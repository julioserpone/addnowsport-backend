<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 28/9/2016
 * Time: 9:06 PM
 */

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateImagen extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'template_imagenes';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','templateSlider_id', 'imagen', 'titulo', 'texto', 'boton', 'nombre_boton', 'vinculo_boton'
    ];

    protected $hidden = [

    ];

    public function createdAt()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }

    public function updatedAt()
    {
        return date('d-m-Y', strtotime($this->updated_at));
    }

    public function deletedAt()
    {
        return date('d-m-Y', strtotime($this->deleted_at));
    }

    public function slider()
    {
        return $this->belongsTo('App\Modelos\TemplateSlider');
    }

}
