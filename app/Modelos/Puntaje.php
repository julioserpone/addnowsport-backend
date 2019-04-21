<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puntaje extends Model {

    use SoftDeletes;
    
    protected $table = 'puntajes';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'competencia_id',
        'puesto',
        'puntos',
    ];

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $hidden = ['id','competencia_id','deleted_at','created_at','updated_at'];

}
