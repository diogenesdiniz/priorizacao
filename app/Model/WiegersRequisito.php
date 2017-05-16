<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 15/05/2017
 * Time: 21:35
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class WiegersRequisito extends Model
{
    protected $fillable = [
        'idrequisito',
        'prejuizo',
        'custo',
        'beneficio',
        'risco'
    ];
}