<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrupoRequest;
use App\Models\Avaliador;
use App\Models\Formulario;
use App\Models\Grupo;
use App\Models\GrupoFormulario;
use App\Models\GrupoUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::all();
        return view('pages.grupo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formularios = Formulario::where('user_id', '=', Auth::user()->id)->get();
        return view('pages.grupo.create', compact('formularios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoRequest $request)
    {
        try {
            DB::beginTransaction();
            $grupo = Grupo::create($request->all());
            GrupoFormulario::create([
                'formulario_id' => $request->formulario_id,
                'grupo_id' => $grupo->id
            ]);
            DB::commit();
            return redirect()->route('grupo.index')->with([
                'type' => 'success',
                'msg' => 'Grupo criado com sucesso.'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'Algo de errado aconteceu. ' . $exception->getMessage()
            ]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('pages.grupo.edit', compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(GrupoRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $grupo = Grupo::findOrFail($id);
            $grupo->update($request->all());
            DB::commit();
            return redirect()->route('grupo.index')->with([
                'type' => 'success',
                'msg' => 'Grupo atulizado com sucesso.'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'Algo de errado aconteceu. ' . $exception->getMessage()
            ]);
        }
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

    public function people($id)
    {
        $grupoUsers = GrupoUser::where('grupo_id', $id)->get();
        return view('pages.grupo.people', compact('grupoUsers', 'id'));
    }

    public function search(Request $request)
    {
        $lists = User::where('name', 'like', '%' . mb_strtoupper($request->term) . '%')->get();
        return response()->json($lists);
    }

    public function removePeople(Request $request)
    {
        try {
            DB::beginTransaction();
            $grupoUsers = GrupoUser::findOrFail($request->grupoUser_id);
            $grupoUsers->delete();
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function addpeople(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->peoples as $people) {
                GrupoUser::create([
                    'grupo_id' => $request->grupo_id,
                    'user_id' => $people['id']
                ]);
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 500);

        }
    }

    public function definirAvaliador($formulario_id,$user_id)
    {
        $formulario = Formulario::findOrFail($formulario_id);
        Avaliador::all();
        $candidatos = new Collection();
        foreach ($formulario->formularioUsuario as $formUser){
            $candidato = Avaliador::where('formulario_usuario',$formUser->id )->first();
            if (is_null($candidato)){
                $candidatos->add($formUser);
            }
        }
        return view('pages.grupo.avaliacao.candidato', compact('candidatos', 'user_id'));
    }

    public function avaliarStore(Request $request){
        try {
            DB::beginTransaction();
            $avaliador = Avaliador::create([
                'avaliador' => $request->avaliador,
                'formulario_usuario' => $request->formulario_usuario
            ]);
            DB::commit();
            return response()->json(['success' => true]);
        }catch(\Exception $exception){
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
