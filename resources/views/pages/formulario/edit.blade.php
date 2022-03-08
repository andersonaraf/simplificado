@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end">
                    <a href="{{route('formulario.index')}}" class="font-weight-bold text-info"><span
                            class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <hr>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">EDITAR FORMULÁRIO</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('formulario.update', $formulario->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="nomeFormulario" class="font-weight-bold">NOME FORMULÁRIO</label>
                                            <input type="text" class="form-control" name="nome"
                                                   id="nomeFormulario" placeholder="RB SIMPLIFICADO {{date('Y')}}"
                                                   value="{{$formulario->nome}}">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="pontuacaoTotal" class="font-weight-bold">PONTUAÇÃO
                                                TOTAL: </label>
                                            <input type="number" class="form-control" name="pontuacao"
                                                   id="pontuacaoTotal" min="0" max="100"
                                                   placeholder="PONTUAÇÃO MÁXIMA DO FORMULÁRIO"
                                                   value="{{$formulario->pontuacao}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group has-info">
                                            <label for="dataInicio" class="font-weight-bold">DATA PARA LIBERAR
                                                FORMULÁRIO: </label>
                                            <input type="datetime-local" class="form-control" name="data_liberar"
                                                   id="dataInicio"
                                                   value="{{date('Y-m-d\TH:i',strtotime($formulario->data_liberar))}}">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group has-info">
                                            <label for="dataFinalizar" class="font-weight-bold">DATA PARA FINALIZAR
                                                FORMULÁRIO: </label>
                                            <input type="datetime-local" class="form-control" name="data_fecha"
                                                   id="dataFinalizar" value="{{date('Y-m-d\TH:i', strtotime($formulario->data_fecha))}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group has-info">
                                            <label for="dataInicioRecurso" class="font-weight-bold">DATA PARA LIBERAR
                                                RECURSO: </label>
                                            <input type="datetime-local" class="form-control" name="data_liberar_recurso"
                                                   id="dataInicioRecurso"
                                                   value="{{!is_null ($formulario->data_liberar_recurso) ? date('Y-m-d\TH:i',strtotime($formulario->data_liberar_recurso)) : ''}}">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group has-info">
                                            <label for="dataFinalizarRecurso" class="font-weight-bold">DATA PARA FINALIZAR
                                                FORMULÁRIO: </label>
                                            <input type="datetime-local" class="form-control" name="data_fecha_recurso"
                                                   id="dataFinalizarRecurso" value="{{!is_null($formulario->data_fecha_recurso) ? date('Y-m-d\TH:i', strtotime($formulario->data_fecha_recurso)) : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="nomeFormulario" class="font-weight-bold" style="color: #00bcd4">STATUS</label>
                                            <select name="liberado" class="form-control">
                                                <option value="1" {{$formulario->liberado ? 'selected' : ''}}>ATIVADO
                                                </option>
                                                <option value="0" {{!$formulario->liberado ? 'selected' : ''}}>
                                                    DESATIVADO
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="statusRecurso" class="font-weight-bold" style="color: #00bcd4">STATUS RECURSO</label>
                                            <select name="liberar_recurso" id="statusRecurso" class="form-control">
                                                <option value="1" {{$formulario->liberar_recurso ? 'selected' : ''}}>ATIVADO
                                                </option>
                                                <option value="0" {{!$formulario->liberar_recurso ? 'selected' : ''}}>
                                                    DESATIVADO
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col col-12 text-md-right text-lg-right text-center">
                                        <div>
                                            <input type="submit" class="btn btn-outline-info font-weight-bold"
                                                   value="ATUALIZAR FORMULÁRIO">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('pages.formulario.editais.index')
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script>
    </script>
@endpush
