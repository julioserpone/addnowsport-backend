<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DatosBancarios extends Model implements IModel
{

    use SoftDeletes;

    protected $table = 'datos_bancarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banco_id',
        'tipo_cuenta',
        'titular',
        'rut',
        'nro_cuenta',
        'banco',
        'correo',
        'valida',
        'activa',
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $hidden = ['banco_id', 'valida', 'created_at', 'updated_at', 'deleted_at'];

    public function stores()
    {
        return $this->hasMany('App\Modelos\Store', 'datos_bancos_id', 'id')->withTrashed();
    }
    
    public function datosBancariosUsuario()
    {
        return $this->hasOne('App\Modelos\DatosBancariosUsuario')->withTrashed();
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

    public function importantes()
    {
        $campos = 0;
            if($this->titular != null)
            {
                $campos++;
            }

            if($this->tipo_cuenta != null)
            {
                $campos++;
            }

            if($this->rut != null)
            {
                $campos++;
            }

            if($this->nro_cuenta != null)
            {
                $campos++;
            }

            if($this->banco != null)
            {
                $campos++;
            }

            if($this->correo != null)
            {
                $campos++;
            }
        
        return $campos;
    }
}
