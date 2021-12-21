@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Configuração do Formulário')])
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
                            <h4 class="card-title font-weight-bold">CONFIGURAÇÃO: {{$formulario->nome}}</h4>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col col-12 col-lg-6 col-md-6">
                                                    <h5 class="font-weight-bold">NÍVEIS ESCOLARIDADE</h5>
                                                </div>
                                                <div class="col col-12 col-lg-6 col-md-6 text-lg-right text-md-right text-left">
                                                    <a href="#" class="text-info" data-toggle="modal" data-target="#modalEscolaridade"><span class="material-icons">add_circle_outline</span>NOVA
                                                        ESCOLARIDADE</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="card-body">
                                            <div class="accordion" id="accordionExample">
                                                @foreach($formulario->escolaridade as $key=>$escolaridade)
                                                    <div class="card">
                                                        <div class="card-header card-header-info" id="healing{{$key}}">
                                                            <div class="row align-middle">
                                                                <div class="col col-6 col-lg-6 col-md-6">
                                                                    <h2 class="mb-0">
                                                                        <input class="btn btn-link btn-block text-left font-weight-bold text-white" type="button"
                                                                               data-toggle="collapse"
                                                                               data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}"
                                                                               value="{{$escolaridade->nivel_escolaridade}}">
                                                                    </h2>
                                                                </div>

                                                                <div class="col col-6 col-lg-6 col-md-6 text-right align-middle">
                                                                    <a href="javascript:void(0);" class="delete_item_sweet"
                                                                       data-action="{{route('escolaridade.destroy', $escolaridade->id)}}">
                                                                        <span class="material-icons text-danger">delete</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="collapse{{$key}}" class="collapse show" aria-labelledby="healing{{$key}}" data-parent="#accordionExample">
                                                            <div class="card-header">
                                                                <h5 class="card-title font-weight-bold">CARGOS</h5>
                                                                <hr>
                                                            </div>
                                                            <div class="card-body">
                                                                @forelse($escolaridade->cargos as $key=>$cargo)
                                                                    <div class="row">
                                                                        <div class="col col-6 col-md-6 col-lg-6">
                                                                            <label class="font-weight-bold text-dark">{{$cargo->cargo}}</label>

                                                                        </div>
                                                                        <div class="col col-6 col-md-6 col-lg-6 text-right">
                                                                            <a href="#" title="CONFIGURAR FORMULÁRIO">
                                                                                <span class="material-icons text-info">settings</span>
                                                                            </a>
                                                                            <span class="font-weight-bold"> | </span>
                                                                            <a href="javascript:void(0);" class="delete_item_sweet"
                                                                               data-action="{{route('cargo.destroy', $cargo->id)}}">
                                                                                <span class="material-icons text-danger">delete</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    @if(count($escolaridade->cargos)-1 == $key)
                                                                        @include('pages.formulario.configuração.cargo.create')
                                                                    @endif
                                                                @empty
                                                                    @include('pages.formulario.configuração.cargo.create')
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
    @include('pages.formulario.configuração.escolaridade.create')
@endsection
@push('js')
    <script src="{{asset('js/confirmaDelete.js')}}"></script>
@endpush
