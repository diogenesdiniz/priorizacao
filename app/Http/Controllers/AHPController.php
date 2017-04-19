<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 17/04/2017
 * Time: 21:33
 */

namespace App\Http\Controllers;


use App\Model\AHPRequisito;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function calcularRanking(Request $request)
    {
        try{
            $array_ahp = [];
            foreach($request->json('requisitos') as $requisito){
                if(count($request->json('requisitos')) != count($requisito['valores']))
                    return new JsonResponse(['success' => false, 'message' => 'A quantidade de valores precisa ser igual a quantidade de requisitos']);

                $ahp = new AHPRequisito();
                $ahp->idrequisito = $requisito['idrequisito'];
                $ahp->valores = $requisito['valores'];
                $array_ahp[] = $ahp;
            }

            $total_coluna = $this->calcularSomaDasColunas($array_ahp);
            $this->normalizarECalcularPrioridade($array_ahp, $total_coluna);
            $prioridade = $this->separarRequisitoPrioridade($array_ahp);
            return new JsonResponse(['success' => true, 'data' => $prioridade]);
        }catch (\Exception $e){
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function calcularSomaDasColunas($array_ahp)
    {
        $total_coluna = [];
        for($i = 0; $i < count($array_ahp); $i++){
            for($j = 0; $j < count($array_ahp[$i]->valores); $j++){
                if(isset($total_coluna[$j])){
                    $total_coluna[$j] += $array_ahp[$i]->valores[$j];
                }else{
                    $total_coluna[$j] = $array_ahp[$i]->valores[$j];
                }
            }
        }
        return $total_coluna;
    }

    private function normalizarECalcularPrioridade($array_ahp, $total_coluna){
        foreach($array_ahp as $ahp){
            $valores_normalizados = [];
            for($i = 0; $i < count($ahp->valores); $i++){
                $valores_normalizados[] = $ahp->valores[$i]/$total_coluna[$i];
            }
            $ahp->valores_normalizados = $valores_normalizados;
            $ahp->prioridade = array_sum($valores_normalizados)/count($valores_normalizados);
        }
    }

    private function separarRequisitoPrioridade($array_php){
        $prioridade = [];
        foreach($array_php as $ahp){
            $da_vez = [
                'idrequisito' => $ahp->idrequisito,
                'prioridade' => $ahp->prioridade * 100
            ];
            $prioridade[] = $da_vez;
        }
        return $prioridade;
    }
}