<?php

namespace App\Http\Controllers\Admin\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\Formulario;
use App\Models\GrupoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupoUsers = GrupoUser::where('user_id', Auth::user()->id)->get();
        return view('pages.relatorio.index', compact('grupoUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $formulario = Formulario::findOrFail($id);
        return view('pages.relatorio.filtro', compact('formulario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function relatorioCompleto($id) {
        $formulario = Formulario::findOrFail($id);
        $pdf = PDF::loadView('pages.relatorio.pdfs.completo', compact('formulario'));
        return $pdf->download('relatorio_completo.pdf', 'relatorio-completo-gerado-'.date('d/m/Y').'.pdf');
//        return view('pages.relatorio.pdfs.completo', compact('formulario'));
    }
}
