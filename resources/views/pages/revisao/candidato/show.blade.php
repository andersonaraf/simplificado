@extends('layouts.app', [ 'activePage' => 'revisao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end has-info">
                    <a href="{{route('revisao.show', $formularioUsuario->formulario->id)}}" class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <div class="row">
                    <h4 class="text-dark font-weight-bold">INFORMAÇÕES DO PARTICIPANTE</h4>
                    <hr style="width: 100%;">
                    @include('pages.revisao.candidato.dados_pessoais')
                    @if(!is_null($reprovar))
                        <div class="col-12">
                            <label for="">Motivo da reprovação</label>
                            <textarea class="form-control" disabled>
                            {{$reprovar->motivo}}
                        </textarea>
                        </div>
                    @endif
                    <form method="post" action="#" id="formPontuar" class="w-100">
                        @csrf
                        @include('pages.revisao.candidato.anexos', ['pontuavel' => true])
                        <div class="row justify-content-end">
                            <div class="col col-12 text-right">
                                @if(is_null($formularioUsuario->recurso) || (!is_null($formularioUsuario->avaliado) && is_null($formularioUsuario->revisado)))
                                    @if($formularioUsuario->avaliado == 1)
                                        <input type="button" data-tipo-avaliacao="APROVAR"
                                               class="btn btn-outline-success font-weight-bold avaliar" value="APROVAR">
                                    @elseif($formularioUsuario->avaliado == 0)
                                        <input type="button" data-tipo-avaliacao="REPROVAR"
                                               class="btn btn-outline-danger font-weight-bold avaliar" value="REPROVAR">
                                    @endif
                                    <input type="button" data-tipo-avaliacao="AVALIACAO"
                                           class="btn btn-outline-warning font-weight-bold avaliar" value="AVALIAÇÃO">
                                @endif
                            </div>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
    <script>
        $(document).ready(function () {
            $('.avaliar').click(function () {
                if ($(this).data('tipo-avaliacao') === 'APROVAR') {
                    swal.fire({
                        icon: 'question',
                        text: 'Tem certeza que deseja aprovar esse formulario?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{route('aprovar.avaliacao')}}',
                                type: 'POST',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    formularioUsuarioID: '{{$formularioUsuario->id}}',
                                },
                                success: (reponse) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: 'Formulário aprovado com sucesso!',
                                        type: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 3000
                                    }).then(function () {
                                        window.location.href = '{{route('revisao.show', $formularioUsuario->formulario_id)}}'
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


                } else if ($(this).data('tipo-avaliacao') === 'REPROVAR') {
                    //SWEET ALERT COM INPUT DE MOTIVO PARA REPROVAR
                    //CONFIRMAR DECISÃO
                    swal.fire({
                        icon: 'question',
                        text: 'Tem certeza que deseja reprovar esse formulário?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{route('reprovar.avaliacao')}}',
                                type: 'POST',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    formularioUsuarioID: '{{$formularioUsuario->id}}',
                                },
                                success: (reponse) => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: 'Formulário reprovado com sucesso!',
                                        type: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 3000
                                    }).then(function () {
                                        window.location.href = '{{route('revisao.show', $formularioUsuario->formulario_id)}}'
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
                        text: 'Tem certeza que deseja voltar para a fila de avaliação?',
                        showCancelButton: true,
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{route('voltar.avaliacao')}}',
                                type: 'POST',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    formularioUsuarioID: '{{$formularioUsuario->id}}',
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
                                        window.location.href = '{{route('revisao.show', $formularioUsuario->formulario_id)}}'
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
        });
    </script>
@endpush

