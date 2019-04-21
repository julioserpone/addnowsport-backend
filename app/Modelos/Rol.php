<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model implements IModel {

    use SoftDeletes;

    protected $table = 'roles';
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'permissions', 'slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'permissions', 'pivot', 'slug','deleted_at', 'created_at', 'updated_at'
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

    /**
     * The usuarios that belong to the group.
     */
    public function usuarios() {
        return $this->belongsToMany('App\Modelos\Usuario');
    }

}
