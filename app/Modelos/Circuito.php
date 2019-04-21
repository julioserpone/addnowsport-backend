<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Circuito extends Model
{
    use SoftDeletes;

    protected $table = 'circuitos';

    public $timestamps = true;

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $hidden = ['id', 'productora_id', 'deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id',
        'nombre',
        'puntos'
    ];


    /**
     * Relacion con Modelo Productora
     * Developer: Gary Romero
     * @return QueryBuilder Query con Modelo
     */
    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

}
