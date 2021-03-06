<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;


class RolUsuario extends Model implements IModel
{

    protected $table = 'rol_usuario';
    protected $primaryKey = "id";
    protected $fillable = ['usuario_id', 'rol_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
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


