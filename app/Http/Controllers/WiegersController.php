<?php
/**
 * Created by PhpStorm.
 * User: Ricutelo
 * Date: 15/05/2017
 * Time: 21:11
 */

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;

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
                
            }
        }catch (\Exception $e){
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}