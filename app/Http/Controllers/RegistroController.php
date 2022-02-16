<?php

namespace App\Http\Controllers;
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

use App\Http\Requests\Registro;
use App\Http\Requests\RegistroPessoa;
use App\Models\Cargo;
use App\Models\EditalDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Endereco;
use App\Models\Genero;
use App\Models\Pessoa;
use App\Models\PessoaEditalAnexo;
use App\Models\Progress;
use App\Models\Termos;
use App\Models\TipoAnexoCargo;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    public function index()
    {
        try {
            $generos = Genero::all();
            //VALIDAR SE A TELA ESTÁ LIBERADA
            $verificarRotaLiberada = new VerificarRotaLiberadaController();
            return view('registro.registro', compact('generos'));
        } catch (Exception $exception) {
            return view('errors.500');
        }
    }

    //CADASTRO DA PESSOA NA 1 REQUISAO
    public function store(RegistroPessoa $request)
    {
        try {

            DB::beginTransaction();
            //CRIAR USER
            $user = new User();
            $user->name = mb_strtoupper($request->nomeCompleto);
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->tipo = 'CANDIDATO';
            $user->block = 0;
            $user->save();


            //CRIAR ENDEREÇO
            $endereco = [];
            $endereco['bairro'] = $request->bairro;
            $endereco['cep'] = $request->cep;
            $endereco['rua'] = $request->rua;
            $endereco['numero'] = $request->numero;
            $endereco['complemento'] = $request->complemento;

            $pessoa = new Pessoa();
            $pessoa->nome_completo = $request->nomeCompleto;
            $pessoa->endereco_id = EnderecoController::store($endereco);
            $pessoa->cpf = $request->cpf;
            $pessoa->rg = $request->rg;
            $pessoa->orgao_emissor = $request->orgaoExpedidor;
            $pessoa->data_nascimento = (isset($request->data_nascimento) ? $request->data_nascimento : date('Y-m-d'));
            $pessoa->email = $request->email;
            $pessoa->portador_deficiencia = $request->pne;
            $pessoa->genero_id = $request->genero;
            $pessoa->user_id = $user->id;
            $pessoa->save();
            //SALVAR OS NUMEROS
            $pessoa->numeroContato()->create([
                'numero' => $request->contato1,
            ]);
            if (!is_null($request->contato2)) {
                $pessoa->numeroContato()->create([
                    'numero' => $request->contato2,
                ]);
            }

//            dd($pessoa->id);
            DB::commit();
            Auth::login($user);
            session()->put('status', 'Salvo Com Sucesso');
            return view('usuario.area_user.index_user');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            return redirect()->route('inicio')->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

    //DEVOLVER PARA O REGISTRO OS DADOS DA PESSOA + ALTERACOES NO STYLE
    public function buscaIndex($id)
    {
        $editalDinamico = EditalDinamico::where('telas_edital_id', $id)->first();
        $pessoa = json_decode(Cookie::get('pessoa'));
        $progress = $this->gerarProgress($editalDinamico->id, $pessoa->cargo_id);
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        //VAI VERIFICAR SE EXISTE ESSE ANEXO NO EDITAL
        $tipoAnexoCargo = $this->gerarTipoAnexoCargo($tipoAnexoCargo, $pessoa->cargo_id, $editalDinamico->id);
        if ($tipoAnexoCargo->count() > 0) {
            $porcetagemProgress = 100 / $tipoAnexoCargo->count();
        } else $porcetagemProgress = 0;

        if (isset($pessoa->id)) {
            Cookie::queue(Cookie::forget('pessoa'));
            Cookie::queue(Cookie::forget('endereco'));
            return redirect()->route('inical');
        }

        return view('registro.registros_anexos', compact('progress', 'pessoa', 'editalDinamico', 'porcetagemProgress', 'tipoAnexoCargo'));
    }


    public function gerarProgress($id, $cargo_id)
    {
//        $progressM = Progress::where('edital_dinamico_id', $id)->get();
        $progress = new Collection();

        foreach ($progressM as $item) {
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::where('tipo_anexo_id', $item->tipo_anexo_id)->where('edital_dinamico_id', $item->edital_dinamico_id)->where('cargo_id', $cargo_id)->first();
            if (!is_null($editalDinamicoTipoAnexo)) $progress->add($item);
        }
        return $progress;
    }

    public function gerarTipoAnexoCargo($tipoAnexo, $cargo_id, $editaDinamicoID)
    {
        $collection = new Collection();
        foreach ($tipoAnexo as $item) {
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::where('tipo_anexo_id', $item->tipo_anexo_id)->where('edital_dinamico_id', $editaDinamicoID)->where('cargo_id', $item->cargo_id)->first();
            if (!is_null($editalDinamicoTipoAnexo)) $collection->add($item);
        }
        return $collection;
    }
}
