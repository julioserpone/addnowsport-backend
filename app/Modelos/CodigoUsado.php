<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodigoUsado extends Model
{
    use SoftDeletes;

    protected $table = 'codigo_usados';

    public $timestamps = true;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_id',
        'usuario_id',
        'productora_id',
        'competencia_id',
    ];

    public function codigo()
    {
        return $this->belongsTo('App\Modelos\Codigo');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Modelos\Usuario');
    }

    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Modelos\Competencia');
    }

    public function scopeOfUsuario($query, $usuario_id)
    {
        $query->where('usuario_id', $usuario_id);
    }

    public function scopeOfCompetencia($query, $competencia_id)
    {
        $query->where('competencia_id', $competencia_id);
    }
}
