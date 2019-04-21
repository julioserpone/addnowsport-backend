<?php

namespace App\Modelos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codigo extends Model
{
    use SoftDeletes;

    protected $table = 'codigos';

    public $timestamps = true;

    protected $dates = ['deleted_at','created_at','updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'usuario_id',
        'productora_id',
        'fecha_inicio',
        'fecha_vencimiento',
        'limite_uso_cupon',
        'limite_uso_usuario',
        'tipo',
        'estatus',
        'codigo',
		'valor_descuento',
		'valor_a_pagar',
		'porcentaje_descuento',
    ];

    /**
     * Registra un codigo. Verifique que si su tipo es free, le asigne un porcentaje al 100%
     * Developer: Julio Hernandez
     * @param  Array        $data               Request
     * @param  Integer      $productora_id      Id de la productora
     * @param  Collection   $usuario            Objeto Usuario
     * @return Collection                       Nuevo objeto Codigo
     */
    public static function registrar($data, $productora_id, $usuario) {

        $data['productora_id'] = $productora_id;
        $data['usuario_id'] = $usuario->id;
        if ($data['tipo'] == 'free') {
            $data['porcentaje_descuento'] = 100;
        }
        return parent::create($data);
    }

    /**
     * Relacion 1-1 con Modelo Usuario
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function usuario() {

        return $this->belongsTo('App\Modelos\Usuario')->withTrashed();
    }

    /**
     * Relacion con Modelo Productora
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function productora() {

        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

    /**
     * Relacion M-M con Modelo CodigoCompetencia
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function competencia() {

        return $this->belongsToMany('App\Modelos\Competencia')->withTrashed()->withPivot(['valor_descuento','valor_a_pagar']);
    }

    /**
     * Atributo Collection que obtiene los codigos usados
     * Developer: Julio Hernandez
     * @return Collection Codigos utilizados
     */
    public function getCodigosUsadosAttribute() {

        return $this->hasMany('App\Modelos\CodigoUsado')->withTrashed()->get();
    }

    /**
     * Relacion N-M con Modelo CodigoUsado
     * Developer: Julio Hernandez
     * @return QueryBuilder Query con Modelo
     */
    public function codigo_usado() {

        return $this->hasMany('App\Modelos\CodigoUsado')->withTrashed();
    }

    /**
     * Atributo Collection perteneciente a un modelo foraneo
     * Developer: Julio Hernandez
     * @return Collection Competencias asociadas al codigo
     */
    public function getCompetenciasAttribute() {

        return $this->belongsToMany('App\Modelos\Competencia')->withTrashed()->get();
    }

    /**
     * Devuelve una Colletion del mismo tipo, junto a las colecciones relacionadas a la tabla
     * Developer: Julio Hernandez
     * @param  Eloquent     $query Query
     * @param  Integer      $id    Id a consultar. Si esta en null, devuelve todos
     * @return Collection   Collection del Modelo sus con relaciones
     */
    public static function scopeFindWithRelations($query, $options = []) {

        $query->with(['usuario','productora','competencia'])->withTrashed();

        if (array_key_exists('id', $options)) {
            $query->where('id', $options['id']);
        }
        if (array_key_exists('codigo', $options)) {
            $query->where('codigo', $options['codigo']);
        }
    }

    /**
     * Query para filtrar registros por rango de fechas
     * Developer: Julio Hernandez
     * @param  QueryBuilder     $query              Objeto QueryBuilder original
     * @param  string           $fecha_inicio       Fecha Inicio
     * @param  string           $fecha_vencimiento  Fecha Vencimiento
     * @return QueryBuilder                         QueryBuilder
     */
    public function scopeOfDates($query, $fecha_inicio = '', $fecha_vencimiento = '') {

        if (trim($fecha_inicio) == '' && trim($fecha_vencimiento) == '') {
            return;
        }

        if (trim($fecha_inicio) != '' && trim($fecha_vencimiento) != '') {
            return $query->where(\DB::raw('DATE(codigos.fecha_inicio)'), '>=', $fecha_inicio)->where(\DB::raw('DATE(codigos.fecha_vencimiento)'), '<=', $fecha_vencimiento);
        } elseif (trim($fecha_inicio) != '' && trim($fecha_vencimiento) == '') {
            return $query->where(\DB::raw('DATE(codigos.fecha_inicio)'), '>=', $fecha_inicio);
        } elseif (trim($fecha_inicio) == '' && trim($fecha_vencimiento) != '') {
            return $query->where(\DB::raw('DATE(codigos.fecha_vencimiento)'), '<=', $fecha_vencimiento);
        }
    }

    /**
     * Query para filtrar por estatus
     * Developer: Julio Hernandez
     * @param  QueryBuilder    $query       Objeto QueryBuilder original
     * @param  string          $estatus     Estatus del codigo
     * @return QueryBuilder                 QueryBuilder
     */
    public function scopeByEstatus($query, $estatus) {

        $query->where('estatus', $estatus);
    }


    /**
     * Metodo para obtener datos del codigo a aplicar para determinada competencia
     * Developer: Julio Hernandez
     * @param  string   $codigo             Codigo a aplicar
     * @param  integer  $competencia_id     Identificador de la competencia
     * @param  integer  $productora_id      Identificador de la productora
     * @return array                        Array con datos del codigo
     */
    public static function aplicarCodigo($codigo, $competencia_id, $productora_id, $usuario) {

        $data = self::with(['competencia','codigo_usado'])->where('codigo', $codigo)->byEstatus('activo')->first();
        $codigo_valido = [];

        if (($data) && ($data->competencia->where('id', $competencia_id)->first())) 
        {
            $costo = CodigoCompetencia::where('competencia_id', $competencia_id)->where('codigo_id', $data->id)->first();
            $codigo_utilizado = $data->utilizadoByUsuario($usuario->id, $competencia_id, $productora_id);

            $codigo_valido = [
                'id' => $data->id,
                'codigo' => $data->codigo,
                'tipo' => $data->tipo,
                'fecha_inicio' => $data->fecha_inicio,
                'fecha_vencimiento' => $data->fecha_vencimiento,
                'porcentaje_descuento' => $data->porcentaje_descuento,
                'costo_grupal' => $data->competencia->where('id', $competencia_id)->first()->costo,
                'costo_individual' => $data->competencia->where('id', $competencia_id)->first()->costo_individual,
                'valor_descuento' => $costo->valor_descuento,
                'valor_a_pagar' => $costo->valor_a_pagar,
            ];
        }
        return $codigo_valido;
    }

    /**
     * Scope para obtener el sql que permite consultar si un codigo se utilizo en determinada competencia
     * @param  QueryBuilder     $query              Objeto QueryBuilder original
     * @param  integer          $usuario_id         Id del Usuario
     * @param  integer          $competencia_id     Id de la competencia
     * @param  integer          $productora_id      Id de la productora
     * @return QueryBuilder                         QueryBuilder
     */
    public function utilizadoByUsuario($usuario_id, $competencia_id, $productora_id) {

        return $this->CodigosUsados->where('usuario_id', $usuario_id)
                                   ->where('productora_id', $productora_id)
                                   ->where('competencia_id', $competencia_id)->first();

    }

    /**
     * Formatea la fecha de inicio antes de procesarla
     * Developer: Julio Hernandez
     * @param Date $value Fecha en formato d/m/Y
     */
    public function setFechaInicioAttribute($value) {

        $this->attributes['fecha_inicio'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    /**
     * Formatea la fecha de vencimiento antes de procesarla
     * Developer: Julio Hernandez
     * @param Date $value Fecha en formato d/m/Y
     */
    public function setFechaVencimientoAttribute($value) {

        $this->attributes['fecha_vencimiento'] = Carbon::createFromFormat('d/m/Y',$value);
    }

}
