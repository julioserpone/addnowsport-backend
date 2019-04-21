<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model implements IModel
{
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['datos_banco_id', 'usuario_id', 'rut', 'razon_social', 'giro', 'correo', 'nombre', 'direccion', 'pais', 'telefono', 'ciudad', 'celular', 'pin_retiro', 'prefix', 'slug', 'monto_disponible', 'comision'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'deleted_at', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function datosbancos()
    {
        return $this->belongsTo(
            'App\Modelos\DatosBancos', 
            'datos_banco_id'
        )->withTrashed();
    }

    public function usuarios()
    {
        return $this->belongsTo(
            'App\Modelos\Usuarios', 
            'usuario_id'
        )->withTrashed();
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