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

class Disciplina extends Model
{
    use SoftDeletes;

    protected $table = 'disciplinas';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'subdisciplina'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
