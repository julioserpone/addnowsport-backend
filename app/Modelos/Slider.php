<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 28/9/2016
 * Time: 9:06 PM
 */

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model implements IModel
{
    use SoftDeletes;

    protected $table = 'sliders';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','propietario_id', 'tipo', 'total', 'efecto', 'status'
    ];

    protected $hidden = [

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

    public function productora()
    {
        return $this->belongsTo('App\Modelos\Productora');
    }

}
