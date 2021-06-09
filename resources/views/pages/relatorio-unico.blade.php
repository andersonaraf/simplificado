@extends('layouts.app', ['activePage' => 'relatorio', 'titlePage' => __('Relatorio')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/area-restrita/avaliar.css')}}">
    <style>
        #progress li {
            width: {{$progressQuantiadePorcento}}% !important;
            height: 220px;
            border: 1px solid #fff;
            padding-top: 3%;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="#">
                        <input type="number" name="pessoa_id" value="{{$pessoa->id}}" hidden/>
                        @csrf
                        @error('motivo_recusar.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <ul id="progress">
                            <li class="ativo">Informações Pessoais</li>
                            <li>Endereço</li>
                            @foreach($tipoAnexoCargo as $tipo)
                                <li>{{$tipo->tipoAnexo->tipo}}</li>
                            @endforeach
                        </ul>
                        @if (!is_null($pessoa->status_avaliado) && $pessoa->status_avaliado == 0)
                            <div class="card text-white bg-warning">
                                <div class="card-header"><h4 class="font-weight-bold">Motivo Reprovar</h4></div>
                                <div class="card-body">
                                    <p class="card-text"
                                       style="font-size: 16px">{{$pessoa->reprovarPessoa($pessoa->id)->motivo}}</p>
                                </div>
                            </div>
                        @endif

                        <fieldset>
                            <h2>Informações Pessoais</h2>
                            <p>Nome Completo</p>
                            <input type="text" placeholder="Nome Completo"
                                   value="{{$pessoa->nome_completo}}" disabled/>
                            <div class="row">
                                <div class="col col-sm-12">
                                    <p>CPF</p>
                                    <input type="text" placeholder="CPF"
                                           value="{{$pessoa->cpf}}" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <p>RG</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->rg}}"
                                           disabled/>
                                </div>
                                <div class="col col-sm-6">
                                    <p>Orgão Emissor</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->orgao_emissor}}"
                                           disabled/>
                                </div>
                            </div>
                            <p>Telefone</p>
                            <input type="text" placeholder="RG"
                                   value="{{$pessoa->telefone}}"
                                   disabled/>

                            <div class="row">
                                <div class="col col-sm-6">
                                    <p>Nacionalidade</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->nacionalidade}}"
                                           disabled/>
                                </div>
                                <div class="col col-sm-6">
                                    <p>Naturalidade</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->naturalidade}}"
                                           disabled/>
                                </div>
                            </div>
                            <p>PNE</p>
                            @if($pessoa->portador_deficiencia == 0)
                                <input type="text" placeholder="RG"
                                       value="Sim"
                                       disabled/>
                            @else
                                <input type="text" placeholder="RG"
                                       value="Não"
                                       disabled/>
                            @endif
                            <p>Data de Inscrição</p>
                            <input type="text" value="{{$pessoa->created_at->format('d-m-Y H:i')}}" disabled>
                            <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                        </fieldset>

                        <fieldset>
                            <h2>Endereço</h2>
                            <p>CEP</p>
                            <input type="text" placeholder="Informe seu CEP"
                                   value="{{$pessoa->endereco->cep}}" disabled/>
                            <p>Bairro</p>
                            <input type="text" placeholder="Informe seu Bairro"
                                   value="{{$pessoa->endereco->bairro}}" disabled/>
                            <p>Endereço</p>
                            <input type="text" placeholder="Informe seu Endereço"
                                   value="{{$pessoa->endereco->endereco}}"
                                   disabled/>
                            <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                            <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                        </fieldset>
                        @foreach($progress as $key=>$progresso)
                            <fieldset>
                                <h2 class="text-center font-weight-bold">{{$progresso->tipoAnexo->tipo}}</h2>
                                <div class="card">
                                    <div class="card-header">CARGO PRETENDIDO:
                                        <h3 class="text-center font-weight-bold">{{$pessoa->cargo->cargo}}</h3>
                                    </div>
                                    @if (!is_null($pessoa->status_avaliado) && $pessoa->status_avaliado == 1)
                                        <div class="row justify-content-center mr-2">
                                            @if(isset($pessoa->pontuacao($pessoa->id)->pontuacao_total_publica))
                                                <label style="font-weight: bold; color: black;"> Pontuação Publica:
                                                    <label style="font-weight: bold; color: black; padding: 10px;">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_publica}}</label>
                                                </label>
                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                            @if(!is_null($pessoa->pontuacao($pessoa->id)))
                                                <label style="font-weight: bold; color: black;"> Pontuação Total:
                                                    <label style="font-weight: bold; color: black; padding: 10px;">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total}}</label>
                                                </label>

                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @foreach($progresso->tipoAnexo->pessoaEditalAnexosPessoa($pessoa->id, $progresso->edital_dinamico_id, $progresso->tipo_anexo_id) as $anexo)
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{$anexo->documentoDinamico->nome_documento}}</h3>
                                        </div>
                                        <div class="card-body text-left">
                                            <h5><a target="_blank" href="{{asset('documentos/'.$anexo->nome_arquivo)}}">Anexo</a>
                                            </h5>
                                            @if(!is_null($anexo->documentoDinamico->pontuacao_maxima) && !is_null($anexo->documentoDinamico->pontuacao_por_item))
                                                <p>Pontuação: <strong
                                                        style="font-weight: bold;">{{$anexo->pontuacao}}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                @if($key != $tipoAnexoCargo->count() - 1)
                                    <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                                @endif
                                <input type="button" name="prev" id="prev" style="width: 11%" class="prev acao" value="Anterior"/>
                            </fieldset>
                        @endforeach
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@include('pages.models.recurso-negar')
@section('script')
    <script src="{{asset('js/contador.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/function.js')}}"></script>
@endsection
