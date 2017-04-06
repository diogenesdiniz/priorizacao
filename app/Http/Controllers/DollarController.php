<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 05/04/2017
 * Time: 22:10
 */

namespace App\Http\Controllers;

use App\Model\DollarRequisito;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DollarController extends Controller
{

    public function calcularRanking(Request $request)
    {
        try{
            $requisitos = collect();
            foreach($request->json('requisitos') as $requisito){
                if(!$requisitos->contains('idrequisito', $requisito['idrequisito'])){
                    $requisito_da_vez = new DollarRequisito();
                    $requisito_da_vez->idrequisito = $requisito['idrequisito'];
                    $requisito_da_vez->valor = $requisito['valor'];
                    $requisito_da_vez->quantidade_entradas++;
                    $requisitos->push($requisito_da_vez);
                }else{
                    $requisito_da_vez = $this->filtrarEntradaRequisitosIguais($requisitos, $requisito['idrequisito']);
                    $requisito_da_vez->valor += $requisito['valor'];
                    $requisito_da_vez->quantidade_entradas++;
                }
            }
            $validar_total = $this->validarTotal($requisitos);
            if($validar_total == false){
                return new JsonResponse(['success' => false, 'message' => 'O valor total precisa ser múltiplo de 100']);
            }
            $ordem = $requisitos->sortByDesc('valor');
            return new JsonResponse(['success' => true, 'data' => $ordem->values()]);
        }catch (\Exception $e){
            return new JsonResponse(['success' => false, $e->getMessage()]);
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

    private function validarTotal($requisitos)
    {
        $total = $requisitos->sum(function($a){
            return $a->valor;
        });
        if($total%100 != 0){
            return false;
        }
        return true;
    }
}