@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <h4 class="text-dark font-weight-bold">INFORMAÇÕES DO PARTICIPANTE</h4>
                    <hr style="width: 100%;">
                    @include('pages.avaliacao.candidato.dados_pessoais')
                    <form method="post" action="#" id="formPontuar" class="w-100">
                        @csrf
                        @include('pages.avaliacao.recurso.recuso')
                        @include('pages.avaliacao.candidato.anexos', ['pontuavel' => false])
                        <div class="row justify-content-end">
                            <div class="col col-12 text-right">
                                <input type="button" data-tipo-avaliacao="APROVAR" data-validar-recurso="ACEITA RECURSO"
                                       class="btn btn-outline-success font-weight-bold avaliar" value="{{isset($recurso) ? 'ACEITA RECURSO' : 'APROVAR'}}">
                                <input type="button" data-tipo-avaliacao="REPROVAR" data-validar-recurso="RECUSAR RECURSO"
                                       class="btn btn-outline-danger font-weight-bold avaliar" value="{{isset($recurso) ? 'RECUSAR RECURSO' : 'REPROVAR'}}">
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
        // Função para avaliar o recurso
        $(document).ready(function () {
            $('.avaliar').click(function () {
                let tipoRecurso = $(this).data('validar-recurso')
                if(tipoRecurso == 'ACEITA RECURSO'){
                    //VERIFICAR NÃO UTRAPASSOU A PONTUAÇÃO MÁXIMA
                    if (parseFloat($('#recursoPontuar').val()) > parseFloat($('#recursoPontuar').attr('max'))) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pontuação inválida',
                            text: 'A pontuação máxima é de ' + $('#recursoPontuar').attr('max'),
                            type: 'error',
                            confirmButtonText: 'OK'
                        })
                        return false;
                    }
                    //ENVIAR UMA REQUISIÇÃO PARA O SERVIDOR LIBERANDO O RECURSO PARA AVALIAÇÃO NOVAMENTE COM PONTUAÇÃO
                    $.ajax({
                        url: '{{route('recurso.store')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            idRecurso: '{{$recurso->id}}',
                            tipoRecurso: 1,
                            recursoPontuacao: $('#recursoPontuar').val(),
                        },
                        success: function (response) {
                            if (response.type== 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sucesso!',
                                    text: 'Recurso validado com sucesso!',
                                    type: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function () {
                                    window.location.href = '{{back()->getTargetUrl()}}';
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro!',
                                    text: 'Ocorreu um erro ao validar o recurso para avaliação!',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function (response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: 'Ocorreu um erro ao validar o recurso para avaliação!',
                                type: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    })
                } else {
                    //ABRE UM SWERT ALERT PARA O USUÁRIO DIGITA O MOTIVO DA RECUSA
                    Swal.fire({
                        icon: 'question',
                        title: 'DESCREVA O MOTIVO PARA RECUSAR O RECURSO',
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Confirmar',
                        showLoaderOnConfirm: true,
                        preConfirm: (motivo) => {
                            return fetch('{{route('recurso.store')}}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    tipoRecurso: 0,
                                    motivoRecusar: motivo,
                                    idRecurso: '{{$recurso->id}}',
                                })
                            })
                                .then(response => response.json())
                                .catch(error => {
                                    Swal.showValidationMessage(
                                        `Request failed: ${error}`
                                    )
                                })
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            if(result.value.type == 'error'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: result.value.msg
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sucesso!',
                                    text: result.value.msg
                                }).then(() => {
                                    window.location.reload()
                                })
                            }
                        }
                    })
                }
            });
        })
    </script>
@endpush
