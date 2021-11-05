<?php

namespace App\Http\Controllers;

use App\Exports\ResultadoExport;
use App\Http\Controllers\Jasper\JasperController;
use App\Http\Requests\RelatorioRequest;
use App\Models\Cargo;
use App\Models\Carrossel;
use App\Models\EditalDinamico;
use App\Models\Escolaridade;
use App\Models\Pessoa;
use App\Models\Progress;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class RelatoriosController extends Controller
{
    //
    public function selecionarEdital()
    {
        $editalDinamicos = EditalDinamico::all();
        return view('pages.relatorio.relatorio-tipo-edital', compact('editalDinamicos'));
    }

    public function index($id)
    {

        if (Auth::user()->tipo != 'Admin') {
            session()->put('error', 'Você não tem permissão para acessar essa página!');
            return redirect()->route('home');
        }


        $pessoas = Pessoa::where('edital_dinamico_id', $id)->get();
        $editalDinamico = EditalDinamico::findOrFail($id);
        $cargos = Cargo::all();
        $niveisEscolaridades = Escolaridade::all();

        return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico'));
    }

    public function gerarRelatorio(RelatorioRequest $request)
    {
        //TIPO
        //1 = TABELA | 2  = PDF
        $tipo = $request->tipo;
        ////
        $cargos = Cargo::all();
        $niveisEscolaridades = Escolaridade::all();
        $editalDinamico = EditalDinamico::findOrFail($request->editalDinamicoID);

        //VERIFICAR SE TODOS ESTÃO VAZIOS
        if (is_null($request->cargoID) && is_null($request->escolaridadeID) && is_null($request->status)) {
            $pessoas = Pessoa::where('edital_dinamico_id', $request->editalDinamicoID);
            $pessoasPNE = Pessoa::where('edital_dinamico_id', $request->editalDinamicoID);
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Processo Seletivo Simplificado ' . date('Y');
            if ($tipo == 1) {
                return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico'));
            } else {
                $pessoas->with('pontuacao2')->where('portador_deficiencia', 0);
                $pessoasPNE->with('pontuacao2')->where('portador_deficiencia', 1);
                $pessoas = $pessoas->get()->sortBy([
                    ['pontuacao2.pontuacao_total', 'desc'],
                    ['data_nascimento', 'asc']
                ]);

                $pessoasPNE = $pessoasPNE->get()->sortBy([
                    ['pontuacao2.pontuacao_total', 'desc'],
                    ['data_nascimento', 'asc']
                ]);
                view()->share(['pessoas', $pessoas, 'pessoasPNE', $pessoasPNE]);
                $pdf = PDF::loadView('pdf_view', compact('pessoas', 'titulo', 'pessoasPNE'));
                return $pdf->download('pdf_file.pdf');
            }
        }
        if ($tipo == 1) {

            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                if (!is_null($request->escolaridadeID)) {
                    $pessoas->where('escolaridade_id', $request->escolaridadeID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                }
            } else if (!is_null($request->escolaridadeID)) {
                $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                }
            } else if (!is_null($request->status)) {
                $pessoas = Pessoa::where('status', $request->status);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->escolaridadeID)) {
                    $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                }
            }
            $pessoas->where('edital_dinamico_id', $request->editalDinamicoID);
            $pessoas = $pessoas->get();
            return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico'));
        }
        // GENERATE PDF
        else if($tipo == 2) {
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                if (!is_null($request->escolaridadeID)) {
                    $pessoas->where('escolaridade_id', $request->escolaridadeID);
                    $pessoasPNE->where('escolaridade_id', $request->escolaridadeID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                    $pessoasPNE->where('status', $request->status);
                }
            } else if (!is_null($request->escolaridadeID)) {
                $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                $pessoasPNE = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                    $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                    $pessoasPNE->where('status', $request->status);
                }
            } else if (!is_null($request->status)) {
                $pessoas = Pessoa::where('status', $request->status);
                $pessoasPNE = Pessoa::where('status', $request->status);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                    $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->escolaridadeID)) {
                    $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                    $pessoasPNE = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                }
            }
            $pessoas->with('pontuacao2')->where('portador_deficiencia', 0);
            $pessoasPNE->with('pontuacao2')->where('portador_deficiencia', 1)->orderBy('data_nascimento', 'ASC');

            $pessoas = $pessoas->get()->sortBy([
                ['pontuacao2.pontuacao_total', 'desc'],
                ['data_nascimento', 'asc']
            ]);
            $pessoasPNE = $pessoasPNE->get()->sortByDesc('pontuacao2.pontuacao_total');
            $carrossel = Carrossel::all()->last();
            if(!$request->show_pne) $pessoasPNE = null;
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Processo Seletivo Simplificado ' . date('Y');
            view()->share('pessoas', $pessoas);
            $pdf = PDF::loadView('pdf_view', compact('pessoas', 'titulo', 'pessoasPNE', 'carrossel'));
            return $pdf->download('pdf_file.pdf');
        }
        else {
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                if (!is_null($request->escolaridadeID)) {
                    $pessoas->where('escolaridade_id', $request->escolaridadeID);
                    $pessoasPNE->where('escolaridade_id', $request->escolaridadeID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                    $pessoasPNE->where('status', $request->status);
                }
            } else if (!is_null($request->escolaridadeID)) {
                $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                $pessoasPNE = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                    $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->status)) {
                    $pessoas->where('status', $request->status);
                    $pessoasPNE->where('status', $request->status);
                }
            } else if (!is_null($request->status)) {
                $pessoas = Pessoa::where('status', $request->status);
                $pessoasPNE = Pessoa::where('status', $request->status);
                if (!is_null($request->cargoID)) {
                    $pessoas = Pessoa::where('cargo_id', $request->cargoID);
                    $pessoasPNE = Pessoa::where('cargo_id', $request->cargoID);
                }
                if (!is_null($request->escolaridadeID)) {
                    $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                    $pessoasPNE = Pessoa::where('escolaridade_id', $request->escolaridadeID);
                }
            }
            $pessoas->with('pontuacao2')->where('portador_deficiencia', 0);
            $pessoasPNE->with('pontuacao2')->where('portador_deficiencia', 1)->orderBy('data_nascimento', 'ASC');

            $pessoas = $pessoas->get()->sortBy([
                ['pontuacao2.pontuacao_total', 'desc'],
                ['data_nascimento', 'asc']
            ]);
            $pessoasPNE = $pessoasPNE->get()->sortByDesc('pontuacao2.pontuacao_total');
            $carrossel = Carrossel::all()->last();
            if(!$request->show_pne) $pessoasPNE = null;
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Gerado_' . date('Y');

            return $this->export($pessoas, $pessoasPNE, $titulo, $carrossel);
        }
    }

    public function requestPDFJasper(Request $request)
    {
        $file = JasperController::index($request->cargo, $request->deferimento);
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file, $request->cargo . '.pdf', $headers);
    }

    public function visualizar($id){
        $pessoa = Pessoa::findOrFail($id);
        $edital_dinamico_id = !is_null($pessoa->pessoaEditalAnexos->first()) ? $pessoa->pessoaEditalAnexos->first()->edital_dinamico_id : null;
        $progress = Progress::where('edital_dinamico_id', $edital_dinamico_id)->get();
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        $progressQuantiadePorcento = 100 / ($tipoAnexoCargo->count() + 2);

        return view('pages.relatorio-unico', compact('pessoa', 'progressQuantiadePorcento', 'progress', 'tipoAnexoCargo'));
    }

    public function export($pessoas, $pessoasPNE, $titulo, $carrossel){
        $resultadoExport = new ResultadoExport($pessoas, $pessoasPNE, $titulo, $carrossel);
        return Excel::download($resultadoExport, 'resultado.xlsx');
    }
}
