<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaldoUsuario extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'saldo_usuarios';

    public $timestamps = true;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'operacion_id',
        'saldo'
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

    public function usuario()
    {
        return $this->belongsTo('App\Modelos\Usuario');
    }

    public function operacion()
    {
        return $this->belongsTo('App\Modelos\Operacion');
    }

}
