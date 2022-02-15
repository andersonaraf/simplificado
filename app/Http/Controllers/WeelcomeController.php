<?php

namespace App\Http\Controllers;

use App\Models\Carrossel;
use App\Models\Formulario;
use App\Models\TelasEdital;
use Illuminate\Http\Request;

class WeelcomeController extends Controller
{
    //

    public function index(){
        $carrossels = Carrossel::all();
        $formularios = Formulario::where('liberado', 1)->get();

        return view('welcome', compact( 'carrossels', 'formularios'));
    }
}
