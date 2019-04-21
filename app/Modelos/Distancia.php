<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distancia extends Model
{

    use SoftDeletes;

    protected $table = 'distancias';
    public $timestamps = true;
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $hidden = ['deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id',
        'nombre',
        'status'
    ];

    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

}
