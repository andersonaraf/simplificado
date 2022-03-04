@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bold">FILTROS</h5>
                            <hr/>

                            <div class="row">
                                <div class="col col-12 col-md-6 col-lg-6 has-info">
                                    <label for="cargo">CARGO</label>
                                    <select class="custom-select" id="cargo">
                                        <option value="TODOS">TODOS</option>
                                        @foreach($formulario->cargos as $cargo)
                                            <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col col-12 col-md-6 col-lg-6">
                                    <label for="Tipo">TIPO</label>
                                    <select class="custom-select" id="tipoAvaliacao">
                                        <option value="0">TODOS</option>
                                        <option value="1">SOMENTE AVALIAÇÃO</option>
                                        <option value="2">SOMENTE RECURSO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">LISTA DE CANDIDATOS</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>NOME CANDIDATO</th>
                                            <th>CPF</th>
                                            <th>CARGO</th>
                                            <th class="text-right">STATUS</th>
                                            <th class="text-right">STATUS RECURSO</th>
                                            <th class="text-right">OPÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @csrf
                                        @foreach(isset($avaliador[0]) ? $avaliador : $formulario->formularioUsuario as $formularioUsuario)
                                            <tr data-cargo-id="{{$formularioUsuario->formularioUsuario->cargo_id}}"
                                                data-tipo-avaliacao="{{is_null($formularioUsuario->formularioUsuario->recurso) ? 1 : 2}}">
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->user->name : mb_strtoupper($formularioUsuario->user->name)}}</td>
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->user->pessoa->cpf : (!is_null($formularioUsuario->user->pessoa) ? $formularioUsuario->user->pessoa->cpf : '')}}</td>
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->cargo->cargo : (!is_null($formularioUsuario->cargo) ? $formularioUsuario->cargo->cargo : '')}}</td>
                                                <td class="text-right">
                                                    @if(isset($avaliador[0]) ? is_null($formularioUsuario->formularioUsuario->avaliado): is_null($formularioUsuario->avaliado))
                                                        <span class="badge badge-pill badge-danger">NÃO AVALIADO</span>
                                                    @elseif(isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->avaliado == 1: $formularioUsuario->avaliado == 1)
                                                        <span class="badge badge-pill badge-success">AVALIADO</span>
                                                    @elseif(isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->avaliado == 0: $formularioUsuario->avaliado == 0)
                                                        <span class="badge badge-pill badge-danger">REPROVADO</span>
                                                    @endif
                                                </td>

                                                <td class="text-right">
                                                    @if(isset($avaliador[0]) ? is_null($formularioUsuario->formularioUsuario->recurso): is_null($formularioUsuario->recurso))
                                                        <span
                                                            class="badge badge-pill badge-warning">NÃO SOLICITADO</span>
                                                    @elseif(isset($avaliador[0]) ? is_null($formularioUsuario->formularioUsuario->recurso->aprovou_recurso): is_null($formularioUsuario->recurso->aprovou_recurso))
                                                        <span
                                                            class="badge badge-pill badge-warning">AGUADANDO APROVAÇÃO</span>
                                                    @elseif(isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->recurso->aprovou_recurso == 1: $formularioUsuario->recurso->aprovou_recurso == 1)
                                                        <span class="badge badge-pill badge-success">RECUSO NA FILA DE AVALIAÇÃO</span>
                                                    @elseif(isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->recurso->aprovou_recurso == 0: $formularioUsuario->recurso->aprovou_recurso == 0)
                                                        <span class="badge badge-pill badge-danger">RECUSO NEGADO</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{route('candidato.show',isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->id : $formularioUsuario->id)}}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                    {{--                                                    SÓ LIBERAR LINK CASO NÃO TENHA SIDO AVALIADO--}}
                                                    @if(isset($avaliador[0]) ? is_null($formularioUsuario->formularioUsuario->avaliado): is_null($formularioUsuario->avaliado))
                                                        <a href="{{route('candidato.edit',isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->id : $formularioUsuario->id)}}"
                                                           class="btn btn-sm btn-primary" title="REALIZAR PONTUAÇÃO">
                                                            <i class="material-icons">123</i>
                                                        </a>
                                                    @endif
                                                    {{--LINK PARA VERIFICAR O RECURSO--}}
                                                    @if(isset($avaliador[0]) ? is_null($formularioUsuario->formularioUsuario->recurso->aprovou_recurso): is_null($formularioUsuario->recurso->aprovou_recurso))
                                                        <a href="{{route('recurso.show', isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->recurso->id : $formularioUsuario->recurso->id)}}"
                                                           class="btn btn-sm btn-warning" title="REALIZAR AVALIAÇÃO DO RECURSO">
                                                            <i class="material-icons">published_with_changes</i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>NOME CANDIDATO</th>
                                            <th>CPF</th>
                                            <th>CARGO</th>
                                            <th class="text-right">STATUS</th>
                                            <th class="text-right">STATUS RECURSO</th>
                                            <th class="text-right">OPÇÕES</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
    <script>
        $(document).ready(function () {
            //ATUALIZAR TABELA COM OS CARGO SELECIONADO NO SELECT ATRAVES DO DATA-CARGO-ID
            $('#cargo').change(function () {
                let cargoId = $(this).val()
                //MOSTRAR TR SOMENTE COM O MESMO CARGO ID
                $('#dataTable tbody tr').each(function () {
                    if (cargoId != "TODOS") {
                        if ($(this).data('cargo-id') == cargoId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            //ATUALIZAR TABELA COM O TIPO DE AVALIACAO SELECIONADO NO SELECT ATRAVES DO DATA-TIPO-AVALIACAO-ID
            $('#tipoAvaliacao').change(function () {
                let tipoAvaliacaoId = $(this).val()
                //MOSTRAR TR SOMENTE COM O MESMO TIPO DE AVALIACAO ID
                $('#dataTable tbody tr').each(function () {
                    if (tipoAvaliacaoId != 0) {
                        if ($(this).data('tipo-avaliacao') == tipoAvaliacaoId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
@endpush
