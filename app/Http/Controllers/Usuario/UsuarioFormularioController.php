<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use App\Models\Collapse;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\FormularioUsuarioCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioFormularioController extends Controller
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
    public function create($cargo_id, $formulario_id)
    {

        $collapses = Collapse::where('cargo_id', $cargo_id)->get();
        return view('usuario.formulario.cadastro', compact('collapses', 'formulario_id', 'cargo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //SALVAR INFORMAÇÕES DO FORMULÁRIO
//        dd($request->all());
        try {
            DB::beginTransaction();
            $formulario_usuario = new FormularioUsuario();
            $formulario_usuario->user_id = Auth::id();
            $formulario_usuario->formulario_id = $request->formulario;
            $formulario_usuario->cargo_id = $request->cargo;
            $formulario_usuario->save();


            //SALVA OS CAMPOS DO FORMULÁRIO
            foreach ($request->all() as $key => $item) {
                if ($key != '_token' && $key != 'formulario' && $key != 'cargo' && $key != 'campos') {
                    $campo = Campo::findOrFail($key);
                    $formularioUsuarioCampo = new FormularioUsuarioCampo();
                    $formularioUsuarioCampo->formulario_usuario_id = $formulario_usuario->id;
                    $formularioUsuarioCampo->campo_id = $campo->id;

                    //VERIFICAR SE É DO TIPO ARQUIVO
                    if (mb_strtoupper($campo->tipoCampo) == 'ARQUIVO'){
                        $fileName = $item->store('usuario/arquivos');
                        $formularioUsuarioCampo->valor = $fileName;
                    }
                    else{
                        $formularioUsuarioCampo->valor = $item;
                    }
                    $formularioUsuarioCampo->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao salvar formulário'], 500);
        }
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
        $formulario = Formulario::findOrFail($id);
        return view('usuario.formulario.show', compact('formulario'));
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
     * @param \Illuminate\Http\Request $request
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
        //
    }
}
