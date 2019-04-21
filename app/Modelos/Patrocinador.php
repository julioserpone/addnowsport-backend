<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrocinador extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'premios';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id', 'competencia_id', 'imagen_id'
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

    public function competencia()
    {
        return $this->belongsTo('App\Modelos\Competencia');
    }

    public function imagen()
    {
        return $this->belongsTo('App\Modelos\Imagen');
    }

}
