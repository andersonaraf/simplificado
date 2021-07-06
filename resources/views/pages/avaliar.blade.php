@extends('layouts.app', ['activePage' => 'avaliacao', 'titlePage' => __('Typography')])

@section('css')
    <link rel="stylesheet" href="{{asset('css/area-restrita/avaliar.css')}}">
    <style>
        #progress li {
            width: {{$progressQuantiadePorcento}}% !important;
            height: 120px;
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
                    <form id="formulario_registro" method="post" action="{{route('avaliador.avaliar.aprovar')}}">
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

                        @if (!is_null($pessoa->status_revisado) && $pessoa->status_revisado == 0)
                            <div class="card text-white bg-warning">
                                <div class="card-header"><h4 class="font-weight-bold">Motivo Reavaliar</h4></div>
                                <div class="card-body">
                                    <p class="card-text"
                                       style="font-size: 16px">{{$pessoa->revisarPessoa($pessoa->id)->motivo}}</p>
                                </div>
                            </div>
                        @endif

                        @error('limite')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


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
                            @if($pessoa->portador_deficiencia == 1)
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

                        @foreach($tipoAnexoCargo as $key=>$progresso)

                            <fieldset>
                                <input type="button" name="next" class="btn btn-danger float-right mr-2"
                                       data-toggle="modal" data-target="#reprovarModel" style="width: 100px"
                                       value="Reprovar"/>
                                <h2 class="text-center font-weight-bold">{{$progresso->tipoAnexo->tipo}}</h2>
                                <div class="card">
                                    <div class="card-header">CARGO PRETENDIDO:
                                        <h3 class="text-center font-weight-bold">{{$pessoa->cargo->cargo}}</h3>
                                    </div>
                                </div>
                                @foreach($progresso->pessoaEditalAnexos($pessoa->id, $pessoa->edital_dinamico_id, $progresso->tipoAnexo->id) as $anexo)

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{$anexo->documentoDinamico->nome_documento}}</h3>
                                        </div>
                                        <div class="card-body text-left">
                                            <h5><a target="_blank" href="{{asset('documentos/'.$anexo->nome_arquivo)}}">Anexo</a>
                                            </h5>
                                            @if ($anexo->documentoDinamico->pontuar_manual)
                                                <label>Pontuação: </label>
                                                <input type="number" value="0" name="anexo[{{$anexo->id}}][]"
                                                       id="anexo[{{$anexo->id}}][]" min="0">
                                            @elseif(is_null($anexo->documentoDinamico->pontuacao_maxima_documento))
                                                <label>Está correto ?</label>
                                                <div class="form-check">
                                                    <input type="radio" value="1" name="anexo[{{$anexo->id}}][]"

                                                           id="anexo[{{$anexo->id}}][]"
                                                           required checked>
                                                    <label class="form-check-label"
                                                           for="anexo[{{$anexo->id}}][]">Sim</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" value="0" name="anexo[{{$anexo->id}}][]"
                                                           id="anexo[{{$anexo->id}}][]">
                                                    <label class="form-check-label"
                                                           for="anexo[{{$anexo->id}}][]">Não</label>
                                                </div>
                                            @else
                                                @if($anexo->documentoDinamico->pontuar_publica_privada==0)
                                                    <input type="number" name="pontuacao_maxima_documento"
                                                           value="{{$anexo->documentoDinamico->pontuacao_maxima_documento}}"
                                                           hidden/>
                                                    <input type="number" name="pontuar_publica_privada"
                                                           value="{{$anexo->documentoDinamico->pontuar_publica_privada=0}}"
                                                           hidden/>

                                                    <label>Pontuação: </label>
                                                    <div class="form-check">
                                                        <input type="radio" value="0" name="anexo[{{$anexo->id}}][]"

                                                               id="anexo[{{$anexo->id}}][]"
                                                               required checked>
                                                        <label class="form-check-label"
                                                               for="anexo[{{$anexo->id}}][]">0</label>
                                                    </div>
                                                    @if (is_null($anexo->documentoDinamico->quantidade_maxima_ano))
                                                        @for($i = $anexo->documentoDinamico->pontuacao_por_item; $i <= $anexo->documentoDinamico->pontuacao_maxima_item; $i = $i + $anexo->documentoDinamico->pontuacao_por_item)
                                                            <div class="form-check">
                                                                <input type="radio" value="{{$i}}"
                                                                       name="anexo[{{$anexo->id}}][]"

                                                                       id="anexo[{{$anexo->id}}][]"
                                                                       required>
                                                                <label class="form-check-label"
                                                                       for="anexo[{{$anexo->id}}][]">{{$i}}</label>
                                                            </div>
                                                        @endfor
                                                    @else
                                                        {{--PONTUACAO POR ANO--}}
                                                        @for($i = 1; $i <= $anexo->documentoDinamico->quantidade_maxima_ano; $i++)
                                                            <div class="form-check">
                                                                <input type="radio"
                                                                       value="{{$anexo->documentoDinamico->pontuacao_por_ano * $i}}"
                                                                       name="anexo[{{$anexo->id}}][]"

                                                                       id="anexo[{{$anexo->id}}][]"
                                                                       required>
                                                                <label class="form-check-label"
                                                                       for="anexo[{{$anexo->id}}][]">{{$anexo->documentoDinamico->pontuacao_por_ano * $i}}</label>
                                                            </div>
                                                        @endfor
                                                    @endif

                                                @else
                                                    <input type="number" name="pontuacao_maxima_documento"
                                                           value="{{$anexo->documentoDinamico->pontuacao_maxima_documento}}"
                                                           hidden/>
                                                    <input type="number" name="pontuar_publica_privada"
                                                           value="{{$anexo->documentoDinamico->pontuar_publica_privada=1}}"
                                                           hidden/>
                                                    <input type="number" name="pontuacao_por_ano"
                                                           value="{{$anexo->documentoDinamico->pontuacao_por_ano}}"
                                                           hidden/>
                                                    <input type="number" name="pontuacao_por_mes"
                                                           value="{{$anexo->documentoDinamico->pontuacao_por_mes}}"
                                                           hidden/>
                                                    <input type="number" min='0' placeholder="Ano"
                                                           name="anexo[{{$anexo->id}}][documento_id]"
                                                           value="{{$anexo->documentoDinamico->id}}" hidden/>
                                                    <input type="number" min='0' placeholder="Ano"
                                                           name="anexo[{{$anexo->id}}][anexo_id]" value="{{$anexo->id}}"
                                                           hidden/>
                                                    <label>Ano: </label>
                                                    <div class="form-check">
                                                        <input type="number" min='0' placeholder="Ano"
                                                               name="anexo[{{$anexo->id}}][anexoAno]"/>
                                                    </div>
                                                    <label>Mês: </label>
                                                    <div class="form-check">
                                                        <input type="number" min='0' placeholder="Mês"
                                                               name="anexo[{{$anexo->id}}][anexoMes]"/>

                                                    </div>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                                @if($key != $tipoAnexoCargo->count() - 1)
                                    <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                                @endif
                                @if($key == $tipoAnexoCargo->count() - 1)
                                    <div class="row justify-content-end">
                                        <input type="submit" name="next" class="btn btn-success mr-3"
                                               style="width: 100px"
                                               value="Aprovar"/>
                                    </div>
                                @endif
                                <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                            </fieldset>
                        @endforeach
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@include('pages.models.reprovar')
@section('script')
    <script src="{{asset('js/area-restrita/avaliar-radio-recusar.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/function.js')}}"></script>
    <script src="{{asset('js/contador.js')}}"></script>
@endsection
