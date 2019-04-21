<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CircuitoCompetencia extends Model
{
    use SoftDeletes;

    protected $table = 'circuitos_competencias';

    public $timestamps = true;

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $hidden = ['id', 'deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competencia_id',
        'circuito_id',
    ];


    /**
     * Relacion con Modelo Circuito
     * Developer: Gary Romero
     * @return QueryBuilder Query con Modelo
     */
    public function circuito()
    {
        return $this->belongsTo('App\Modelos\Circuito')->withTrashed();
    }

    /**
     * Relacion con Modelo Competencia
     * Developer: Gary Romero
     * @return QueryBuilder Query con Modelo
     */
    public function competencia()
    {
        return $this->belongsTo('App\Modelos\Competencia')->withTrashed();;
    }
}
