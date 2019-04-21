<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ayuda extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'ayudas';

    public $timestamps = true;

    protected $dates = ['tiempo_inicio', 'tiempo_fin', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id', 'json', 'seccion', 'solucionado', 'evaluacion'
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

    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora');
    }


}
