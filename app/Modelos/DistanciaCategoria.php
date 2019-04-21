<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistanciaCategoria extends Model
{
    use SoftDeletes;

    protected $table = 'distancia_categorias';

    public $timestamps = true;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distancia_id', 'categoria_id'
    ];

    public function distancia()
    {
        return $this->belongsTo('App\Modelos\Distancia');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Modelos\Categoria');
    }

}
