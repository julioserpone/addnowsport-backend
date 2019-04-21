<?php

namespace App\Modelos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fecha extends Model
{

    use SoftDeletes;

    protected $table = 'fechas';
    public $timestamps = true;
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $hidden = ['paso','competencia_id', 'deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competencia_id',
        'fecha_competencia',
        'ubicacion',
        'paso',
    ];

    public function competencia()
    {
        return $this->belongsTo('App\Modelos\Competencia')->withTrashed();
    }

    public function distancia()
    {
        return $this->belongsToMany('App\Modelos\Distancia')->withTrashed();
    }

    /**
     * Atributo Collection perteneciente a un modelo foraneo
     * Developer: Julio Hernandez
     * @return Collection Distancias asociadas a una fecha
     */
    public function getDistanciasAttribute() {

        return $this->belongsToMany('App\Modelos\Distancia')->withTrashed()->get();
    }

    /**
     * Formatea la fecha de la competencia antes de procesarla
     * @param Date $value Fecha en formato d/m/Y
     */
    public function setFechaCompetenciaAttribute($value) {

        $this->attributes['fecha_competencia'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    /**
     * Formatea la fecha de la competencia luego de procesarla
     * @param Date $value Fecha en formato d/m/Y
     */
    public function getFechaCompetenciaAttribute() {

        return Carbon::parse($this->attributes['fecha_competencia'])->format('d/m/Y');
    }

}
