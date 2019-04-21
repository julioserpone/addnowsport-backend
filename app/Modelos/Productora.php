<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productora extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'productoras';
    protected $imagePath = '/images/';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'imagen_id',
        'cuit',
        'rut',
        'giro',
        'nombre',
        'pais',
        'provincia',
        'ciudad',
        'razon_social',
        'correo',
        'direccion',
        'prefijo_t',
        'telefono',
        'prefijo_c',
        'celular',
        'pin_retiro',
        'descripcion',
        'slug',
        'facebook',
        'twitter',
        'google',
        'avatar',
        'website',
    ];

    protected $hidden = ['id', 'pin_retiro', 'usuario_id', 'current_step', 'created_at', 'updated_at', 'deleted_at'];

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

    /**
     * Relationships model
     *
     */   
    public function usuarios()
    {
        return $this->belongsTo(
            'App\Modelos\Usuario', 
            'usuario_id'
        )->withTrashed();
    }

    /**
     * Relationships competencia
     *
     */
    public function competencias()
    {
        return $this->hasMany(
            'App\Modelos\Competencia',
            'productora_id','id'
        );
    }
    
    /**
     * Relationships categoria
     *
     */
    public function categoria()
    {
        return $this->hasMany(
                        'App\Modelos\Categoria', 'distancia_id', 'id'
                )->withTrashed();
    }

    public function importantes()
    {
        $campos = 0;
            if($this->nombre != null)
            {
                $campos++;
            }

            if($this->razon_social != null)
            {
                $campos++;
            }

            if($this->rut != null)
            {
                $campos++;
            }

            if($this->pais != null)
            {
                $campos++;
            }

            if($this->provincia != null)
            {
                $campos++;
            }

            if($this->correo != null)
            {
                $campos++;
            }

            if($this->pin_retiro != null)
            {
                $campos++;
            }

        return $campos;
    }

    public function imagen()
    {
        return $this->belongsTo('App\Modelos\Imagen', 'imagen_id');
    }

    /**
     * Relationships banco
     *
     */
    public function bancos() {
        return $this->hasMany( 'App\Modelos\DatosBancariosProductoras', 'productora_id' )->with('datosBancarios');
    }

    public function bancosPorcentaje() {
        return $this->hasMany( 'App\Modelos\DatosBancariosProductoras', 'productora_id' )->with('datosBancariosPorcentaje');
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function search(array $data)
    {   
        $valor = $data['valor'];
        $modelo = Productora::where('nombre', 'LIKE', '%'.$valor.'%')
            ->orWhere('rut', 'LIKE', '%'.$valor.'%')
            ->orWhere('giro', 'LIKE', '%'.$valor.'%')
            ->orWhere('nombre', 'LIKE', '%'.$valor.'%')
            ->orWhere('pais', 'LIKE', '%'.$valor.'%')
            ->orWhere('ciudad', 'LIKE', '%'.$valor.'%')  
            ->orWhere('razon_social', 'LIKE', '%'.$valor.'%')           
            ->orWhere('correo', 'LIKE', '%'.$valor.'%')           
            ->orWhere('direccion', 'LIKE', '%'.$valor.'%')           
            ->orWhere('descripcion', 'LIKE', '%'.$valor.'%')           
            ->orWhere('slug', 'LIKE', '%'.$valor.'%')           
            ->orWhere('facebook', 'LIKE', '%'.$valor.'%')           
            ->orWhere('twitter', 'LIKE', '%'.$valor.'%')           
            ->orWhere('google', 'LIKE', '%'.$valor.'%')          
            ->get();

        return $modelo;
    }
}
