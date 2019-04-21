<?php

namespace App\Modelos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPay extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'webpay';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orden_compra', 'tipo_transaccion', 'monto', 'tipo_pago',
        'numero_cuotas', 'fecha_transaccion', 'fecha_contable',
        'codigo_autorizacion', 'id_transaccion', 'id_sesion', 'final_numero_tarjeta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'status', 'deleted_at', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];


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

    public function getTipoPago()
    {
        return $this->tipo_pago;
    }

    public function getStringTipoPago()
    {
        switch($this->tipo_pago)
        {
            case 1: return 'Sin Cuotas'; //VN
            case 2: return 'Cuotas Normales'; //VC
            case 3: return 'Sin interés'; //SI
            case 4 : return 'Cuotas Comercio'; //CI
            case 5 : return 'Débito'; //VD
            default: return "";
        }
    }

    public function getTipoTransaccion()
    {
        return $this->tipo_transaccion;
    }

    public function getStringTipoTransaccion()
    {
        switch($this->tipo_transaccion)
        {
            case 1: return 'TR_NORMAL'; //
            case 2: return ''; //
            case 3: return ''; //
            case 4 : return ''; //
            case 5 : return ''; //
            default: return "";
        }
    }

    public static function hasOrden($nro_orden)
    {
        return Webpay::where('orden_compra', $nro_orden)->count() > 0;
    }

    public function getFechaTransaccion()
    {
        return date('d/m/Y', strtotime($this->fecha_transaccion));
    }

    public function getHoraTransaccion()
    {
        return date('His', strtotime($this->fecha_transaccion));
    }

    public function getFechaContable()
    {
        return date('md', strtotime($this->fecha_transaccion));
    }

}
