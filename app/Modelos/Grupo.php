<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model {

    use SoftDeletes;
    
    protected $table = 'grupos';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'productora_id',
        'nombre',
        'status',
    ];

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $hidden = ['deleted_at','created_at','updated_at'];

}
