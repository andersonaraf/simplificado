@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Configuração do Formulário')])
@push('css')
    <style>
        ::placeholder {
            color: white !important;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end">
                    <a href="{{route('configuracao.create', $cargo->escolaridade->formulario->id)}}"
                       class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                    <b class="text-info ml-2"> | </b>
                    <a href="{{route('formulario.index')}}" class="font-weight-bold text-info ml-2">FORMULÁRIOS</a>
                </div>
                <hr>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">
                                CONFIGURAÇÃO: {{$cargo->escolaridade->formulario->nome}}</h4>
                            <b class="card-subtitle">{{$cargo->cargo}}</b>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="col col-12 co-lg-12 col-md-12 text-right">
                                <input type="button" class="btn btn-outline-info font-weight-bold" data-toggle="modal"
                                       data-target="#novoCollapse" value="NOVO CAMPO">
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="accordion" id="accordionExample">
                                            @forelse($cargo->collapse as $key=>$collapse)
                                                <div class="card">
                                                    <div class="card-header card-header-info">
                                                        <a class="font-weight-bold text-white"  id="heading{{$key}}"
                                                           data-toggle="collapse"
                                                           href="#collapse{{$key}}" aria-expanded="true"
                                                           aria-controls="collapse{{$key}}">
                                                            {{$collapse->nome}}
                                                            <i class="material-icons text-white">keyboard_arrow_down</i>
                                                        </a>
                                                    </div>
                                                    <div id="collapse{{$key}}" class="collapse show"
                                                         aria-labelledby="heading{{$key}}"
                                                         data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            @forelse($collapse->campos as $campo)
                                                            @empty
                                                                <div class="row justify-content-center">
                                                                    <h5 class="font-weight-bold">ESSE CAMPO NÃO POSSUI
                                                                        ANEXOS.</h5>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <h5 class="font-weight-bold">ESSE FORMULÁRIO NÃO POSSUI
                                                            CAMPOS</h5>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    @include('pages.formulario.configuração.campos.create')
@endsection
@push('js')
    <script>
        @error('nomeCollapse')
        $('#novoCollapse').modal().show()
        @enderror
    </script>
@endpush
