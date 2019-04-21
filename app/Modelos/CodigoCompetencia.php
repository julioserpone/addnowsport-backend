<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodigoCompetencia extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'codigo_competencia';

    public $timestamps = true;

    protected $dates = ['deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo_id',
		'competencia_id',
        'valor_descuento',
        'valor_a_pagar',
    ];

    public function createdAt()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }

    public function updatedAt()
    {
        return date('d-m-Y', strtotime($this->updated_at));
    }

    public function deletedAt()
    {
        return date('d-m-Y', strtotime($this->deleted_at));
    }

    public function codigo()
    {
        return $this->belongsTo('App\Modelos\Codigo');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Modelos\Competencia');
    }
}
