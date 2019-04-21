<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transferencias extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'transferencias';

    public $timestamps = true;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id', 'fecha_solicitud', 'fecha_solventada' ,'nro_operacion',
        'codigo', 'monto', 'estado', 'rc', 'recibo'
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

    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora');
    }

}
