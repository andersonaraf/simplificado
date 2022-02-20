<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Mail\Comprovante;
use App\Models\Campo;
use App\Models\Cargo;
use App\Models\Collapse;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\FormularioUsuarioCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioFormularioController extends Controller
{
    public function __construct()
    {
        $this->middleware('acesso.formulario');
    }

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
        $cargo = Cargo::findOrFail($cargo_id);
        if ($cargo->bloquear == 0) return redirect()->route('inicio');
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
        //VERIFICAR SE O USUÁRIO JÁ ESTÁ NO EDITAL
        $formularioUsuario = FormularioUsuario::where('formulario_id', $request->formulario)->where('user_id', Auth::id())->first();
        if (!is_null($formularioUsuario)) return response()->json(['error' => 'Você já está cadastrado nesse formulário.'], 422);

        //SALVAR INFORMAÇÕES DO FORMULÁRIO
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
                    if (mb_strtoupper($campo->tipoCampo->tipo) == 'ARQUIVO') {
                        $fileName = $item->store('usuario/arquivos');
                        $formularioUsuarioCampo->valor = $fileName;
                    } else {
                        $formularioUsuarioCampo->valor = mb_strtoupper($item);
                    }
                    $formularioUsuarioCampo->save();
                }
            }
            $formulario = Formulario::findOrFail($request->formulario);
            $comprovante =  \App\Models\Comprovante::create([
                'comprovante' => Hash::make(Auth::user()->id.date('Y-m-d H:i:s')),
                'formulario_usuario_id'=>$formulario_usuario->id
            ]);
            DB::commit();
            \App\Jobs\Comprovante::dispatch(Auth::user(), $formulario, $comprovante)->delay(now()->addSeconds('15'));
            return response()->json(['status' => true], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
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
