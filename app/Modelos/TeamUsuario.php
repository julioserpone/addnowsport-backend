<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamUsuario extends Model {

    use SoftDeletes;
    
    protected $table = 'team_usuario';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'team_id',
    ];

    protected $dates = ['deleted_at','created_at','updated_at'];

    public function usuario() {
        return $this->belongsTo('App\Modelos\Usuario');
    }

    public function team() {
        return $this->belongsTo('App\Modelos\Team')->withTrashed();
    }

}
