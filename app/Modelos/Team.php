<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
	use SoftDeletes;

    protected $table = 'teams';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'estatus',
    ];

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $hidden = ['deleted_at','created_at','updated_at'];

    public function activo($query, $estatus = true) {

        $query->withTrashed()->where('estatus', ($estatus) ? 'activo' : 'inactivo');

    }
}
