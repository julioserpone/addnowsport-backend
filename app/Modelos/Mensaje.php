<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensaje extends Model implements IModel
{
    use SoftDeletes;
    protected $connection = 'mysql';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection = 'mensajes';
    protected $primaryKey = 'id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'deleted_at', 'created_at', 'updated_at'
    ];
    protected $dates = ['deleted_at'];
    protected $rules = [
        'mensaje' => 'required|string',
        'usuario_remitente' => 'required|integer|exists:usuarios,id',
        'usuario_destinatario' => 'required|integer|exists:usuarios,id',
    ];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mensaje', 'usuario_remitente' ,  'usuario_destinatario'
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

}
