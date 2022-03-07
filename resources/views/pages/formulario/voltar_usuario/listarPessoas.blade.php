@extends('layouts.app', [ 'activePage' => 'listarFormulario', 'subActivePage' => 'listarFormulario', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end has-info">
                    <a href="{{route('formulario.index')}}" class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">Lista de Formulários</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>CARGO</th>
                                            <th class="text-right">AÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @csrf
                                        @foreach($formularioUsuarios as $formularioUsuario)
                                            @if(!is_null($formularioUsuario->revisado) && !is_null($formularioUsuario->revisado))
                                                <tr>
                                                    <td>{{$formularioUsuario->user->name}}</td>
                                                    <td>{{$formularioUsuario->cargo->cargo}}</td>
                                                    <td class="text-right">
                                                        <a href="javascript:void(0);"
                                                           data-id="{{$formularioUsuario->id}}" class="tipo"
                                                           data-tipo="AVALIACAO">
                                                            <button class="btn btn-outline-info">Voltar Avaliação
                                                            </button>
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                           data-id="{{$formularioUsuario->id}}" class="tipo"
                                                           data-tipo="REVISAO">
                                                            <button class="btn btn-outline-warning">Voltar Revisão
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>NOME</th>
                                            <th>CARGO</th>
                                            <th class="text-right">AÇÕES</th>
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
            $('.tipo').click(function () {
                if ($(this).data('tipo') === 'AVALIACAO') {
                    swal.fire({
                        icon: 'question',
                        text: 'Tem certeza que deseja voltar para a fila de avaliação?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{route('voltar.usuario.avaliacao')}}',
                                type: 'POST',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    formularioUsuarioID: $(this).data('id'),
                                },
                                success: (reponse) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: 'Formulário voltou pra fila de avaliação!',
                                        type: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 3000
                                    }).then(function () {
                                        window.location.reload()
                                    })
                                }, error: (response) => {
                                    let error = JSON.parse(response.responseText);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro!',
                                        text: error.error,
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            })
                        }
                    })
                } else {
                    swal.fire({
                        icon: 'question',
                        text: 'Tem certeza que deseja voltar para a fila de revisão?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{route('voltar.usuario.revisao')}}',
                                type: 'POST',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    formularioUsuarioID: $(this).data('id'),
                                },
                                success: (reponse) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: 'Formulário voltou pra fila de revisão!',
                                        type: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 3000
                                    }).then(function () {
                                        window.location.reload()
                                    })
                                }, error: (response) => {
                                    let error = JSON.parse(response.responseText);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro!',
                                        text: error.error,
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            })
                        }
                    })
                }
            })

        })
    </script>
@endpush
