<?php

namespace App\Http\Controllers;

use App\Models\DocumentoDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Progress;
use Illuminate\Http\Request;

class DocumentoDinamicoController extends Controller
{
    //
    public function destroy($id)
    {
        $documentoDinamico = DocumentoDinamico::findOrFail($id);
        $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::findOrFail($documentoDinamico->edital_dinamico_tipo_anexo_id);
        $editalDinamicoID = $documentoDinamico->editalDinamicoTipoAnexo->edital_dinamico_id;
        $progress = Progress::where('tipo_anexo_id', $editalDinamicoTipoAnexo->tipo_anexo_id)->first();
        $quantidadeAnexoParaDeletarOProgress = EditalDinamicoTipoAnexo::where('edital_dinamico_id', $editalDinamicoTipoAnexo->edital_dinamico_id)->where('tipo_anexo_id', $editalDinamicoTipoAnexo->tipo_anexo_id)->get()->count();
        if ($documentoDinamico->delete() && $editalDinamicoTipoAnexo->delete()) {
            if ($quantidadeAnexoParaDeletarOProgress == 1) $progress->delete();
            session()->put('sucess', 'Documento deletado com sucesso.');
        } else session()->put('error', 'Não foi possível remover esse documento.');

        return redirect()->route('edital.formulario.anexo', $editalDinamicoID);
    }
}
