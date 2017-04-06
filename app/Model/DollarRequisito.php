<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 05/04/2017
 * Time: 22:23
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class DollarRequisito extends Model
{
    protected $fillable = [
        'idrequisito',
        'valor',
        'quantidade_entradas'
    ];
}