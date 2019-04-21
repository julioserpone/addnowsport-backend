<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competencia extends Model
{
    use SoftDeletes;

    protected $table = 'competencias';
    public $timestamps = true;
    protected $dates = ['deleted_at','created_at','updated_at'];
    
    protected $distancias;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productora_id', 
        'disciplina_id',
        'puntaje_id',
        'imagen_id',
        'nombre', 
        'dominio', 
        'subdominio',
        'costo', 
        'costo_individual', 
        'titulo', 
        'texto', 
        'subtitulado',
        'descripcion', 
        'bases', 
        'cantidad_integrantes', 
        'estatus', 
        'tipo',
        'facebook', 
        'twitter', 
        'google',
        'json'
    ];

    protected $hidden = ['productora_id', 'disciplina_id', 'foto_id', 'puntaje_id', 'estatus', 'created_at', 'updated_at', 'deleted_at'];


    /**
     * Relacion Productora Origen
     * Developer: Julio Hernandez
     * @return QueryBuilder QueryBuilder modificado
     */
    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

    /**
     * Relacion Disciplina Origen
     * Developer: Julio Hernandez
     * @return QueryBuilder QueryBuilder modificado
     */
    public function disciplina()
    {
        return $this->belongsTo('App\Modelos\Disciplina')->withTrashed();
    }

    /**
     * Relacion de Fechas asociadas a una competencia
     * Developer: Julio Hernandez
     * @return QueryBuilder QueryBuilder modificado
     */
    public function fechas()
    {
        return $this->hasMany('App\Modelos\Fecha')->withTrashed();
    }

    public function avatar()
    {
        return $this->hasOne('App\Modelos\Imagen', 'id', 'imagen_id');
    }

    /**
     * Relacion de Inscripciones asociadas a una competencia
     * Developer: Julio Hernandez
     * @return QueryBuilder QueryBuilder modificado
     */
    public function inscriptos()
    {
        return $this->hasMany('App\Modelos\Inscripto')->withTrashed();
    }

    public function tabla()
    {
        return $this->hasMany('App\Modelos\Puntaje')->withTrashed();
    }

    /**
     * Devuelve los codigos asociados a la competencia como un atributo del modelo
     * Developer: Julio Hernandez
     * @return [type] [description]
     */
    public function getCodigosAttribute()
    {
        return $this->belongsToMany('App\Modelos\Codigo')->get();
    }


    public function getFechasAttribute()
    {
        return $this->hasMany('App\Modelos\Fecha')->get();
    }

    /**
     * Devuelve una collection de distancias asociadas a una competencia. Estas distancias corresponden a cada una de las fechas disponibles en la competencia
     * Developer: Julio Hernandez
     * @return Collection Distancias disponibles por fecha
     */
    public function getDistanciasAttribute()
    {
        $list = Collection::make();
        $data = $this->fechas->each(function ($fecha, $key) use (&$list) {
            if ($fecha->distancias->count()) {
                $list = $list->merge($fecha->distancias);
            }
        });
        $this->distancias = $list;

        return $this->distancias;
    }

    /**
     * Scope para buscar competencias de una productora
     * Developer: Julio Hernandez
     * @param  QueryBuilder     $query      QueryBuilder Original
     * @param  Integer          $id         Id del Usuario que realiza la consulta
     * @param  array            $fields     Campos que se desean devolver
     * @return QueryBuilder                 QueryBuilder modificado
     */
    public function scopeFromProductora($query, $id, $fields = ['*']) {

        return $query->join('productoras', function($join) use ($id) {
            $join->on('productoras.id', '=', 'competencias.productora_id');
        })->where('productoras.usuario_id', $id)->select($fields);
    }

    /**
     * Devuelve una Colletion del mismo tipo, junto a las colecciones relacionadas a la tabla
     * Developer: Julio Hernandez
     * @param  Eloquent     $query Query
     * @param  Integer      $id    Id a consultar. Si esta en null, devuelve todos
     * @return Collection   Collection del Modelo sus con relaciones
     */
    public static function scopeFindWithRelations($query, $id = null) {

        $query->with(['fechas','productora','disciplina'])->withTrashed();

        if ($id) {
            $query->where('id', $id);
        }
    }

    /**
     * Funcion estatica para asociar Codigos a competencias.
     * Developer: Julio Hernandez
     * @param  Collection   $codigo         Objeto Codigo al cual se le asociaran las competencias
     * @param  Collection   $productora     Objeto Productora utilizado para filtras solo las competencias de esta productora
     * @param  Integer      $competencia_id Id de la competencia. Si competencia_id es negativo, se asocia un codigo a todas las competencias de una o mas productoras
     * @param  boolean      $delete         flag para indicar que se desean eliminar las asociaciones previas antes de registrarlas
     * @return void                         
     */
    public static function asociarCodigo($codigo, $productora, $competencia_id, $delete = false) {

        if ($competencia_id == -1) {
            $competencias = self::where('productora_id', $productora->id)->where('status','activo')->get();
            foreach ($competencias as $competencia) {

                if ($delete) {
                    CodigoCompetencia::where('codigo_id', $codigo->id)->where('competencia_id', $competencia->id)->forceDelete();
                }

                CodigoCompetencia::create([
                    'codigo_id' => $codigo->id,
                    'competencia_id' => $competencia->id,
                    'valor_descuento' => $competencia->descuento($codigo->porcentaje_descuento),
                    'valor_a_pagar' => $competencia->valor_pagar($codigo->porcentaje_descuento),
                ]);
            }
        } else {
            //Asocio el codigo unicamente a la competencia seleccionada
            $competencia = self::find($competencia_id)->first();

            if ($delete) {
                CodigoCompetencia::where('codigo_id', $codigo->id)->where('competencia_id', $competencia_id)->forceDelete();
            }

            CodigoCompetencia::create([
                'codigo_id' => $codigo->id,
                'competencia_id' => $competencia_id,
                'valor_descuento' => $competencia->descuento($codigo->porcentaje_descuento),
                'valor_a_pagar' => $competencia->valor_pagar($codigo->porcentaje_descuento),
            ]);
        }
    }

    /**
     * Determina el monto a descontar
     * Developer: Julio Hernandez
     * @param  Double   $descuento  Porcentaje de Descuento
     * @return Double               Porcentaje aplicado al monto (costo)
     */
    public function descuento($descuento) {

        return ($this->costo * $descuento) / 100;
    }

    /**
     * Determina el monto a pagar
     * Developer: Julio Hernandez
     * @param  Double   $descuento  Porcentaje de Descuento
     * @return Double               Monto a pagar (con aplicacion de descuento)
     */
    public function valor_pagar($descuento) {

        return $this->costo - $this->descuento($descuento);
    }
}
