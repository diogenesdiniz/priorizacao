<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 30/03/2017
 * Time: 21:06
 */
class MoscowRequisito extends Model
{
    protected $fillable = [
        'idrequisito',
        'must',
        'should',
        'could',
        'want',
        'quantidade_entradas'
    ];
}