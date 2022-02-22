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
                                        @foreach(auth()->user()->formularios() as $formulario)
                                            <tr>
                                                <td>{{$formulario->nome}}</td>
                                                <td>{{$formulario->formularioUsuario->count()}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('formulario.show', $formulario->id)}}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    {{--relatorio completo--}}
                                                    <a href="{{route('relatorio.formulario.completo', $formulario->id)}}" id="relatorio-completo" data-route="{{route('relatorio.formulario.completo', $formulario->id)}}"
                                                       class="btn btn-sm btn-success">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                </td>
                                            </tr>
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
                //sweetalert avisando que o pdf será enviado por e-mail quando concluir de processar
                Swal.fire({
                    title: "Aviso",
                    text: "O relatório será enviado por e-mail quando concluir de processar",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        //ENVIAR REQUISIÇÃO PARA PROCESSAR O RELATÓRIO
                        $.ajax({
                            url: $(this).data('route'),
                            type: "GET",
                            success: function (data) {
                                //sweetalert avisando que o relatório foi processado com sucesso
                                Swal.fire({
                                    title: "Aviso",
                                    text: "O relatório foi processado com sucesso",
                                    icon: "success",
                                    buttons: false,
                                    dangerMode: true,
                                });
                                //redirecionar para o relatório
                                // window.open(data.url, '_blank');

                            },
                            error: function (data) {
                                //sweetalert avisando que o relatório não foi processado
                                Swal.fire({
                                    title: "Aviso",
                                    text: "O relatório não foi processado.",
                                    icon: "error",
                                    buttons: false,
                                    dangerMode: true,
                                });
                            }
                        });
                    }
                });

            });
        });
    </script>
@endpush
