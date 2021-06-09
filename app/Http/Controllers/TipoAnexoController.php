<?php

namespace App\Http\Controllers;

use App\Models\TipoAnexo;
use Illuminate\Http\Request;

class TipoAnexoController extends Controller
{
    //
    public function destroy($id)
    {
        $tipoAnexo = TipoAnexo::findOrFail($id);
        $id = $tipoAnexo->cargo->id;
        if ($tipoAnexo->delete()) {
            session()->put('sucess', 'Removido com sucesso.');
        }

        return redirect()->route('formulario.show', $id);
    }

    public function store(Request $request)
    {
        $tipoAnexo = new TipoAnexo();
        $tipoAnexo->tipo = $request->inputTitulo;

        if ($tipoAnexo->save()) {
            session()->put('sucess', 'Título criado com sucesso.');
        } else session()->put('error', 'Não foi possível criar um novo título.');

        return redirect()->route('edital.formulario.anexo', $request->editalDinamicoID);
    }
}
