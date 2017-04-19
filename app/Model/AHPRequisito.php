<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 18/04/2017
 * Time: 21:45
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class AHPRequisito extends Model {

    protected $fillable = [
        'idrequisito',
        'valores',
        'valores_normalizados',
        'total_coluna',
        'prioridade'
    ];

}