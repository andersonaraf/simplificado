<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use App\Models\Campo;
use App\Models\Collapse;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracaoFormularioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $formulario = Formulario::findOrFail($id);
        //BLOQUEAR FORMULÁRIO
        if ($formulario->formularioUsuario->count() > 0) return redirect()->back()->with(['type' => 'error', 'msg' => 'Formulário bloqueado para edição!'], 403);

        return view('pages.formulario.configuração.create', compact('formulario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colapse = Collapse::findOrFail($request->collapse_id);
        if ($colapse->cargo->escolaridade->formulario->formularioUsuario->count() > 0) return redirect()->back()->with(['type' => 'error', 'msg' => 'Formulário bloqueado para edição!'], 403);
        try {
            DB::beginTransaction();
            $atributo = new Atributo();
            $atributo->name = $this->textformat($request->titulo_campo);
            $atributo->attr_id = $this->textformat($request->titulo_campo);;
            $atributo->placeholder = !is_null($request->placeholder) ? $request->placeholder : '';
            $atributo->required = isset($request->required_campo) ? 1: 0;
            $atributo-> save();

            $campo = new Campo();
            $campo->collapse_id = $request->collapse_id;
            $campo->atributo_id = $atributo->id;
            $campo->nome = $request->titulo_campo;
            $campo->pontuar = !is_null($request->pontuacao) ? 1 : 0  ;
            $campo->ponto = !is_null($request->pontuacao) ? $request->pontuacao : 0  ;
            $campo->tipo_campo_id = $request->tipo_campo;
            $campo-> save();
            DB::commit();
            return redirect()->back()->with('status','Salvo Com Sucesso');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->withException($e->getMessage());
        }
    }

   public function textformat($string){
      $string =strtolower( str_replace(' ','', $string));
       return preg_replace(array("/(ç)/","/(Ç)/","/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","c C a A e E i I o O u U n N"),$string);
   }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->create($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        try {
//            \DB::beginTransaction();
//            $formulario = Formulario::findOrFail($id);
//            $formulario->delete();
//            \DB::commit();
//            return response()->json('Formulário removido com sucesso.');
//        } catch (\Exception $exception) {
//            dd($exception);
//            \DB::rollBack();
//            return response()->json(false, '405');
//        }
    }
}
