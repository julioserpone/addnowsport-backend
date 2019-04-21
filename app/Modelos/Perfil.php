<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model implements IModel {

    use SoftDeletes;

    protected $table = 'perfiles';
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'proveedor', 'usuario_social_id', 'identificacion', 'imagen_id',
        'genero', 'usuario_social_attributes', 'telefono', 'pais',
        'ciudad', 'profesion', 'descripcion', 'prefijo', 'provincia'
    ];

    protected $hidden = [
        'id', 'status', 'deleted_at', 'created_at', 'updated_at'
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

    public static function create(array $attr = []) {
        if (!isset($attr['usuario_id']) && isset($attr['usuario'])) {
            $usuario = Usuario::create($attr['usuario']);
            //Asocio el rol USUARIO por defecto al nuevo usuario
            $rol = Rol::where('slug', 'usuario')->first();
            $rol_usuario = RolUsuario::create(['usuario_id' => $usuario->id, 'rol_id' => $rol->id]);
            //Asociacion del nuevo usuario con el perfil
            $attr['usuario_id'] = $usuario->id;
            unset($attr['usuario']);
        }
        return parent::create($attr);
    }

    public static function register($data, $provider, $new_user = false, $user = null) {

        $credenciales = self::setCredenciales($data, $provider, $new_user);

        if (isset($credenciales['usuario'])) {
            $new = Usuario::create($credenciales['usuario']);
            $credenciales[$provider]['usuario_id'] = $new->id;
            unset($credenciales['usuario']);
            
            //Si es nuevo usuario, registrar primero el perfil USUARIO por defecto
            if ($new_user) {
                //Asocio el rol USUARIO por defecto al nuevo usuario
                $rol = Rol::where('slug', 'usuario')->first();
                $rol_usuario = RolUsuario::create(['usuario_id' => $new->id, 'rol_id' => $rol->id]);
                $data = [
                    'usuario_id' => $credenciales[$provider]['usuario_id'],
                    'proveedor' => 'psp',
                ];
                //Registro del perfil
                parent::create($data);
            }
        }

        if (!$new_user) $credenciales[$provider]['usuario_id'] = $user->id;
        
        return parent::create($credenciales[$provider]);
    }

    public static function perfilUsuarioActivo($usuario_id)
    {
        return Perfil::where('usuario_id', $usuario_id)->get();
    }

    public static function setCredenciales($data, $provider, $new_user = false) {

        $credenciales[$provider] = [
            'proveedor' => $provider,
            'usuario_social_id' => $data->id,
            'usuario_social_attributes' => json_encode($data->user),
        ];

        if (isset($data->user->gender)) {
            $credenciales[$provider]['genero'] = $data->user->gender;
        }
        
        if ($new_user) {
            $credenciales['usuario'] = [
                'email' => $data->email,
                'password' => bcrypt('12345678'),
                'nombre' => $data->name,
                'avatar' => $data->avatar,
                'social' => 1,
                'hash_activacion' => hash(env('ENCRYPTION_ALGORITHM'), $data->email),
            ];

            $nombre = (!empty($data->name) && !is_null($data->name)) ? explode(" ", $data->name) : [];
            if (!empty($nombre) && count($nombre) > 0) {
                $credenciales['usuario']['nombre'] = $nombre[0];
                $credenciales['usuario']['apellido'] = $nombre[1];
            }
            if (!is_null($data->nickname)) {
                $credenciales['usuario']['username'] = $data->nickname;
            }
            if (isset($data->avatar_original)) {
                $credenciales['usuario']['avatar_original'] = $data->avatar_original;
            }
        }

        return $credenciales;
    }

    public function usuario() {
        return $this->belongsTo('App\Modelos\Usuario');
    }

    public function imagen()
    {
        return $this->belongsTo('App\Modelos\Imagen', 'imagen_id');
    }

}
