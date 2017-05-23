<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 15/05/2017
 * Time: 21:11
 */

namespace App\Http\Controllers;


use App\Model\WiegersRequisito;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WiegersController extends Controller
{
    public function calcularRanking(Request $request)
    {
        try{

            $peso_beneficio = $request->json('peso_beneficio');
            $peso_prejuizo = $request->json('peso_prejuizo');
            $peso_custo = $request->json('peso_custo');
            $peso_risco = $request->json('peso_risco');

            $beneficio_prejuizo_total = 0;
            $custo_total = 0;
            $risco_total = 0;
            $requisitos = collect();
            foreach($request->json('requisitos') as $requisito){
                $wiegers_requisito = new WiegersRequisito();
                $wiegers_requisito->idrequisito = $requisito['idrequisito'];
                $wiegers_requisito->beneficio = $requisito['beneficio'];
                $wiegers_requisito->prejuizo = $requisito['prejuizo'];
                $wiegers_requisito->risco = $requisito['risco'];
                $wiegers_requisito->custo = $requisito['custo'];
                $wiegers_requisito->beneficio_prejuizo = ($requisito['beneficio']*$peso_beneficio + $requisito['prejuizo']*$peso_prejuizo);
                $requisitos->push($wiegers_requisito);


                $beneficio_prejuizo_total = $wiegers_requisito->beneficio*$peso_beneficio + $wiegers_requisito->prejuizo*$peso_prejuizo;
                $risco_total += $wiegers_requisito->risco;
                $custo_total += $wiegers_requisito->custo;
            }

            foreach($requisitos as $requisito){
                $requisito->porcentagem_beneficio_prejuizo = ($requisito->beneficio_prejuizo / $beneficio_prejuizo_total)*100;
                $requisito->porcentagem_custo = ($requisito->custo/$custo_total)*100;
                $requisito->porcentagem_risco = ($requisito->risco/$risco_total)*100;

                $requisito->prioridade = $requisito->porcentagem_beneficio_prejuizo / ($requisito->porcentagem_custo*$peso_custo + $requisito->porcentagem_risco*$peso_risco);
            }

            $ordenados = $requisitos->sortByDesc('prioridade');
            return new JsonResponse(['success' => true, 'data' => $ordenados->values()->all()]);
        }catch (\Exception $e){
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}