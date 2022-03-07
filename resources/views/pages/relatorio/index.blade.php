@extends('layouts.app', [ 'activePage' => 'formularios-relatorios', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">LISTA DE FORMULÁRIOS</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <x-formulario>
                                        @csrf
                                        @foreach($grupoUsers as $grupoUser)
                                            @foreach($grupoUser->grupo->grupoFormularios as $grupoFormulario)
                                                <tr>
                                                    <td>{{$grupoFormulario->formulario->nome}}</td>
                                                    <td>{{$grupoFormulario->formulario->formularioUsuario->count()}}</td>
                                                    <td class="text-right">
                                                        {{--                                                    <a href="{{route('formulario.show', $formulario->id)}}"--}}
                                                        {{--                                                       class="btn btn-sm btn-primary">--}}
                                                        {{--                                                        <i class="fas fa-eye"></i>--}}
                                                        {{--                                                    </a>--}}
                                                        {{--relatorio completo--}}
                                                        <a href="{{route('relatorio.formulario.completo', $grupoFormulario->formulario->id)}}"
                                                           id="relatorio-completo" class="btn btn-sm btn-success">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                        {{--relatorio COM filtro--}}
                                                        <a href="{{route('lista.show', $grupoFormulario->formulario->id)}}"
                                                           id="relatorio-filtro"
                                                           title="GERAR RELATÓRIOS POR FILTRO"
                                                           class="btn btn-sm btn-dark">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </x-formulario>
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
    <script src="{{asset('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#relatorio-completo').click(function (e) {
                //SWETALERT COM LOADING E AVISO
                Swal.fire({
                    icon: 'info',
                    title: 'Aguarde',
                    text: 'Gerando relatório...',
                    timer: 1500,
                    didOpen: () => {
                        swal.showLoading()
                    },
                })
            });
        });
    </script>
@endpush
