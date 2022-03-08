<?php

namespace App\Http\Controllers\Admin\Configuracao\Formulario;

use App\Http\Controllers\Controller;
use App\Models\Editais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class EditaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            DB::beginTransaction();
            //VERIFICAR SENÃO EXISTE ARQUIVO, CASO NÃO EXISTA VOLA A PAGINA COM WARNING DE OBRIGATÓRIO
            if (!$request->hasFile('arquivo')) return redirect()->back()->with(['type' => 'warning', 'msg' => 'O arquivo é obrigatório']);
            //VERIFICAR SE O ARQUIVO É UM PDF, EXECEL OU WORD
            if (!in_array($request->arquivo->extension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx'])) return redirect()->back()->with(['type' => 'warning', 'msg' => 'O arquivo deve ser um PDF, Excel ou Word']);
            //SALVA ARQUIVO NA STORAGE DOCUMENTOS
            $nomeArquivo = $request->arquivo->store('documentos');
            $edital = new Editais();
            $edital->formulario_id = $request->formulario_id;
            $edital->titulo = mb_strtoupper($request->titulo);
            $edital->descricao = mb_strtoupper($request->descricao);
            $edital->documento = $nomeArquivo;
            $edital->hierarquia = $request->hierarquia;
            $edital->save();
            DB::commit();
            return redirect()->route('formulario.edit', $request->formulario_id)->with(['type' => 'success', 'msg' => 'Edital cadastrado com sucesso!']);
        } catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'msg' => 'Erro ao cadastrar edital.']);
        }
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
        try {
            DB::beginTransaction();
            $edital = Editais::find($id);
            $edital->delete();
            DB::commit();
            return response()->json(['type' => 'success', 'msg' => 'Edital excluído com sucesso!']);
        } catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['type' => 'error', 'msg' => 'Erro ao excluir edital.']);
        }
    }
}
