<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 30/03/2017
 * Time: 21:16
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Model\MoscowRequisito;

class MoscowController extends Controller
{
    public function calcularRanking(Request $request)
    {
        $requisitos = collect();
        foreach($request->json('requisitos') as $requisito){
            if(!$requisitos->contains('idrequisito', $requisito['idrequisito'])){
                $requisito_da_vez = new MoscowRequisito();
                $requisito_da_vez->idrequisito = $requisito['idrequisito'];
                $requisito['entrada'] == "must" ? $requisito_da_vez->must++ : "";
                $requisito['entrada'] == "should" ? $requisito_da_vez->should++ : "";
                $requisito['entrada'] == "could" ? $requisito_da_vez->could++ : "";
                $requisito['entrada'] == "want" ? $requisito_da_vez->want++ : "";
                $requisito_da_vez->quantidade_entradas++;
                $requisitos->push($requisito_da_vez);
            }else{
                $valor = $this->filtrar($requisitos, $requisito['idrequisito']);
                $requisito['entrada'] == "must" ? $valor->must++ : "";
                $requisito['entrada'] == "should" ? $valor->should++ : "";
                $requisito['entrada'] == "could" ? $valor->could++ : "";
                $requisito['entrada'] == "want" ? $valor->want++ : "";
                $valor->quantidade_entradas++;
            }

        }
        $ordenado = $requisitos->sortByDesc('must');
        $ordenado2 =   $ordenado->sortByDesc('should');
        return new JsonResponse($ordenado2);
    }

    private function filtrar($valor, $id)
    {
        foreach($valor as $requisito){
            if($requisito->idrequisito == $id){
                return $requisito;
            }
        }
        return null;
    }
}