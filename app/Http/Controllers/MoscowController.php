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
        try{
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
                    $valor = $this->filtrarEntradaRequisitosIguais($requisitos, $requisito['idrequisito']);
                    $requisito['entrada'] == "must" ? $valor->must++ : "";
                    $requisito['entrada'] == "should" ? $valor->should++ : "";
                    $requisito['entrada'] == "could" ? $valor->could++ : "";
                    $requisito['entrada'] == "want" ? $valor->want++ : "";
                    $valor->quantidade_entradas++;
                }
            }

            $igualdade = $this->validarEntradas($requisitos);
            if($igualdade == false){
                return new JsonResponse(['success' => false, 'message' => 'A quantidade de entradas precisa ser igual para cada requisito']);
            }

            $criteria = ['must' => 'desc', 'should' => 'desc', 'could' => 'desc', 'want' => 'desc'];
            $comparer = $this->makeComparer($criteria);
            $ordenado = $requisitos->sort($comparer);

            return new JsonResponse(['success' => true, 'data' => $ordenado->values()]);
        }catch(\Exception $e){
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function filtrarEntradaRequisitosIguais($valor, $id)
    {
        foreach($valor as $requisito){
            if($requisito->idrequisito == $id){
                return $requisito;
            }
        }
        return null;
    }

    private function validarEntradas($requisitos){
        if($requisitos->count() == 0 || $requisitos->count() == 1){
            return true;
        }
        for($i = 0; $i < $requisitos->count(); $i++){
            for($j = 0; $j < $requisitos->count(); $j++){
                if($requisitos->get($i)->quantidade_entradas != $requisitos->get($j)->quantidade_entradas){
                    return false;
                }
            }
        }
        return true;
    }

    private function makeComparer($criteria)
    {
        $comparer = function($primeiro, $segundo) use($criteria)
        {
            foreach($criteria as $key => $orderType){
                $orderType = strtolower($orderType);
                if($primeiro->{$key} < $segundo->{$key}){
                    return $orderType === "asc" ? -1 : 1;
                }else if($primeiro->{$key} > $segundo->{$key}){
                    return $orderType === "asc" ? 1 : -1;
                }
            }
            return 0;
        };
        return $comparer;
    }


}