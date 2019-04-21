<?php

namespace App\Modelos;

use App\Jobs\SendEmail;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Iluminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class Usuario extends Authenticatable implements IModel {


    use SoftDeletes, Notifiable, DispatchesJobs;
    
    protected $table = 'usuarios';
    public $timestamps = true;
    protected $imagePath = '/images/';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'apellido',
        'email', 
        'password',
        'fecha_nacimiento',
        'username', 
        'usuario',
        'social',
        'status',
        'nombre_contacto',
        'prefijo_contacto',
        'telefono_contacto',
        'derivacion_contacto',
        'activado',
        'hash_activacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['id', 'pin_retiro','password', 'last_login', 'usuario', 'productora_activa', 'rol_activo', 'recordarme', 'social', 'status', 'activado', 'remember_token', 'hash_activacion',  'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $touches = ['teams'];

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

    /*
     * Este atributo se almacena dentro de la variable $appends al momento de hacer un get() de este modelo. Se trae todos los roles que tenga el usuario
     * Posteriormente, se puede utilizar el metodo hasRole para determinar si el usuario posee algun role especifico. Este metodo puede recibir un string o un array de roles
     */
    public function getRolesAttribute()
    {
        return $this->belongsToMany('App\Modelos\Rol')->get();
    }

    public function getProductorasAttribute()
    {
        return $this->hasMany('App\Modelos\Productora')->withTrashed();
    }

    /**
     * Atributo para obtener un array de Ids de las productoras que gestiona determinada Administradora. Si el usuario autenticado es administradora, con este metodo se pueden conseguir todas las productoras que administra
     * @return Array Devuelve un array de ids
     */
    public function getProductorasIdAttribute() {

        //The pluck method retrieves all of the values for a given key:
        return $this->productoras->get()->pluck('id')->all();
    }

    public function getNombreCompletoAttribute()
    {
        return "$this->nombre $this->apellido";
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->attributes['fecha_nacimiento'])->age;
    }

    public function hasRole($role)
    {

        if (is_array($role)) {
            return $this->roles->whereIn('slug', $role)->count() ? true : false;
        }
        return $this->roles->where('slug', $role)->count() ? true : false;
    }

    public function getRoleActivoAttribute($role = null) {

        return self::where('id', $this->id)->first()->rol_activo;
    }

    public function registrarPerfilSocial($data, $provider, $new_user = false) {

        $usuario = ($new_user) ? : $this;
        $perfil = Perfil::register($data, $provider, $new_user, $usuario);
        return self::with('perfil')->where('id', $perfil->usuario_id)->get();
    }

    public function perfil() {
        return $this->hasMany('App\Modelos\Perfil');
    }

    public function teams() {
        return $this->belongsToMany('App\Modelos\Team')->withTimestamps();
    }

    public function stores() {
        return $this->hasMany('App\Modelos\Store')->withTrashed();
    }
    
    public function datosBancariosUsuario()
    {
        return $this->hasOne('App\Modelos\DatosBancariosUsuario')->withTrashed();
    }

    public function productora() {
        return $this->belongsTo('App\Modelos\Productora')->withTrashed();
    }

    public function sendMail($options = [])
    {
        $data = [];
        $url_attachments = storage_path().'/files/documents/'.$this->username.'/';
        if ($options) {
            switch ($options['process']) {
                case 'activacion':
                    $template = 'emails.activate';
                    $email = $this->email;
                    $subject = trans('emails.cuentas.activacion');
                    $data['hash_activacion'] = $this->hash_activacion;

                    //Si la carpeta no existe, la creamos
                    //if (!is_dir($url_attachments)) {
                    //    mkdir($url_attachments, 0777, true);
                    //}

                    //attach files
                    $attachments = [];
                    //    'doc_name' => $documento,
                    //];
                break;
            }
        } 
        if (isset($options['command'])) {
            $command = $options['command'];
            switch ($command) {
                case 'process':
                    dd('Execute for console command');
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        //Asignar parametros a variable data
        $data['id'] = $this->id;
        $data['model'] = $this;
        $data['email'] = $email;
        $data['subject'] = $subject;
        $data['template'] = $template;
        
        if ($attachments) $data['attachments'] = $attachments;

        if (isset($template)) {
            $job = (new SendEmail($data))->onQueue('emails');
            $this->dispatch($job);
        }
    }

    /**
     * envia la notificacion de reseteo de contraseña.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /*public static function attempt($array, $remember)
    {
        $usuario = Usuario::where('email', $array['email'])->where('password', hash(env('ENCRYPTION_ALGORITHM'),$array['password']))->first();

        if(sizeof($usuario) > 0)
        {
            Auth::loginUsingId($usuario->id, $remember);
            return true;
        };
        return false;
    }*/
    
    public static function autenticar($data)
    {
        $usuario = self::where('email', $data['email'])
                    ->where('password', hash(env('ENCRYPTION_ALGORITHM'),$data['password']))->first();

        if($usuario) {
            $token = JWTAuth::fromUser($usuario);
            return ['token' => $token, 'roles' => $usuario->roles, 'rol_activo' => $usuario->rol_activo, 'recordarme' => $usuario->recordarme ];
        };
        return false;
    }

    public static function isAuthenticate() {

        return JWTAuth::parseToken()->authenticate();
    }

}
