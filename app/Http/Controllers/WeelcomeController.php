<?php

namespace App\Http\Controllers;

use App\Models\Carrossel;
use App\Models\Formulario;
use App\Models\Recurso;
use App\Models\TelasEdital;
use Illuminate\Http\Request;

class WeelcomeController extends Controller
{
    //

    public function index(){
        $carrossels = Carrossel::all();
        $formularios = Formulario::where('liberado', 1)->where('data_fecha', '>=', date('Y-m-d H:i:s'))->get();
        $recursos  =  Formulario::where('liberado', 1)->where('data_fecha_recurso', '>=', date('Y-m-d H:i:s'))->where('data_liberar_recurso', '<=', date('Y-m-d H:i:s'))->take(3)->get();
        return view('welcome', compact( 'carrossels', 'formularios', 'recursos'));
    }
}
