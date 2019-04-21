<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'movimientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario_id', 'tipo', 'nro', 'fecha', 'monto', 'comprobante'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function usuario()
    {
        return $this->belongsTo('App\Modelos\Usuario');
    }

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

}