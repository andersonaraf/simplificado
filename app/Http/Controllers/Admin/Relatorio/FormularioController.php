<?php

namespace App\Http\Controllers\Admin\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Formulario;
use App\Models\GrupoUser;
use App\User;
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

    public function relatorioPorFiltro(Request  $request){
        if(is_null($request->cargoId)) return redirect()->back()->with(['type' => 'warning', 'msg' => 'Selecione um cargo para filtrar o relatório.']);
        if (!is_null($request->nomeParticipante)) $user = User::where('name', 'like', '%'.mb_strtoupper($request->nomeParticipante).'%')->get();
        else $user = null;

        $cargo = Cargo::findOrFail($request->cargoId);
        $cargo->tipoAprovacao = $request->tipoAprovacao;
        $cargo->pne = $request->pne;
        $cargo->nomeParticipante = $request->nomeParticipante;
        $formulario = Formulario::findOrFail($request->formulario_id);
        $pne = $request->pne;
        $tipoAprovacao = $request->tipoAprovacao;
        $pdf = PDF::loadView('pages.relatorio.pdfs.filtro', compact('formulario', 'cargo'));
        return $pdf->download('relatorio-com-filtro.pdf', 'relatorio-com-filtro-gerado-'.date('d/m/Y').'.pdf');
//        return view('pages.relatorio.pdfs.filtro', compact('cargo', 'formulario'));

    }
}
