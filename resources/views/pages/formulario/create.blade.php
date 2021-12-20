@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end">
                    <a href="{{route('formulario.index')}}" class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <hr>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">CRIAR FORMULÁRIO</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('formulario.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="nomeFormulario" class="font-weight-bold">NOME FORMULÁRIO</label>
                                            <input type="text" class="form-control" name="nomeFormulario" id="nomeFormulario" placeholder="RB SIMPLIFICADO {{date('Y')}}">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="pontuacaoTotal" class="font-weight-bold">PONTUAÇÃO TOTAL: </label>
                                            <input type="number" class="form-control" name="pontuacaoTotal" id="pontuacaoTotal" min="0" max="100"
                                                   placeholder="PONTUAÇÃO MÁXIMA DO FORMULÁRIO">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="form-group has-info">
                                            <label for="dataInicio" class="font-weight-bold">DATA PARA LIBERAR FORMULÁRIO: </label>
                                            <input type="datetime-local" class="form-control" name="dataInicio" id="dataInicio">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="dataFinalizar" class="font-weight-bold">DATA PARA FINALIZAR FORMULÁRIO: </label>
                                            <input type="datetime-local" class="form-control" name="dataFinalizar" id="dataFinalizar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col col-12 text-md-right text-lg-right text-center">
                                        <div>
                                            <input type="submit" class="btn btn-outline-info font-weight-bold" value="CRIAR FORMULÁRIO">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="">
    </script>
@endpush
