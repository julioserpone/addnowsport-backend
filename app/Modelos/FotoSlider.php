<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoSlider extends Model implements IModel {

    use SoftDeletes;
    
    protected $table = 'foto_sliders';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imagen_id',
        'slider_id',
    ];

    protected $dates = ['deleted_at','created_at','updated_at'];

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

    public function slider()
    {
        return $this->belongsTo('App\Modelos\Slider');
    }
    public function foto()
    {
        return $this->belongsTo('App\Modelos\Foto');
    }

}
