<?php

namespace App\Http\Controllers;

use App\Models\TelasEdital;
use Illuminate\Http\Request;

class VerificarRotaLiberadaController extends Controller
{
    //
    public function verificarTelaEdital(TelasEdital $edital){
        if ($edital->status_liberar == 1) return true;

        if ($edital->status_liberar == 0 && is_null($edital->data_fecha) && !is_null($edital->data_liberar)){
            if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date('Y-m-d H:i:s', $edital->data_liberar))) return true;
        }

        if ($edital->status_liberar == 0 && !is_null($edital->data_fecha) && !is_null($edital->data_liberar)) {
            if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date('Y-m-d H:i:s', $edital->data_liberar)) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date('Y-m-d H:i:s', $edital->data_fecha)) ) {
                return true;
            }
        }
        return false;
    }
}
