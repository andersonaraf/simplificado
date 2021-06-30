<?php

namespace App\Http\Controllers;

use App\Models\DocumentoDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Progress;
use Illuminate\Http\Request;
use Exception;

class
DocumentoDinamicoController extends Controller
{
    public function destroy($id)
    {
        try {
            $documentoDinamico = DocumentoDinamico::findOrFail($id);
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::findOrFail($documentoDinamico->edital_dinamico_tipo_anexo_id);
            $progress = Progress::where('tipo_anexo_id', $editalDinamicoTipoAnexo->tipo_anexo_id)->first();
            $documentoDinamico->delete();
            $editalDinamicoTipoAnexo->delete();
            $progress->delete();
            return true;

        } catch (Exception $ex) {
            return response()->withException($ex->getMessage());
        }

    }
}
