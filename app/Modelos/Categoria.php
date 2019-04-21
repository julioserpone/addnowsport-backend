<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{

    use SoftDeletes;

    protected $table = 'categorias';
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
        'grupo_id',
        'nombre',
        'edad_inicio',
        'edad_final',
        'texto_informativo',
        'tipo'
    ];

    /**
     * Relacion con Modelo Productora
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

    /**
     * Relacion con Modelo Grupo
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function grupo()
    {
        return $this->belongsTo('App\Modelos\Grupo')->withTrashed();
    }

    public static function scopeFromProductora($query, $productora_id)
    {
        return $query->where('productora_id', $productora_id);
    }

    public function scopeRangoPermitido($query, $usuario) {

        return $query->where('edad_inicio', '<=', $usuario->edad)
                     ->where('edad_final', '>=', $usuario->edad); 
    }


}
