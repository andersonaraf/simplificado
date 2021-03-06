@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end has-info">
                    <a href="{{route('escolher.show', $formularioUsuario->formulario->id)}}" class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <div class="row">
                    <h4 class="text-dark font-weight-bold">INFORMAÇÕES DO PARTICIPANTE</h4>
                    <hr style="width: 100%;">
                    @include('pages.avaliacao.candidato.dados_pessoais')
                    <form method="post" action="#" id="formPontuar" class="w-100">
                        @csrf
                        @include('pages.avaliacao.candidato.anexos', ['pontuavel' => true])
                        <div class="row justify-content-end">
                            <div class="col col-12 text-right">
                                <input type="button" data-tipo-avaliacao="APROVAR"
                                       class="btn btn-outline-success font-weight-bold avaliar" value="APROVAR">
                                <input type="button" data-tipo-avaliacao="REPROVAR"
                                       class="btn btn-outline-danger font-weight-bold avaliar" value="REPROVAR">
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
                    //GET ALL INPUTS
                    let inputs = $('#formPontuar').find('input')
                    //MAP INPUTS
                    let pontuacoes = []
                    let send = false;
                    inputs.map(function (index, element) {
                        if ($(this).data('usuario-campo') != undefined || $(this).data('usuario-campo') != null) {
                            //VEFICAR O MAX INPUT
                            //VALIDATE MAX
                            if (parseFloat($(this).val()) > parseFloat($(this).attr('max'))) {
                                //SHOW SPAN ERRO
                                $('#span-' + $(this).data('usuario-campo')).css('display', 'block')
                                $('#error-' + $(this).data('usuario-campo')).text('Valor máximo de ' + $(this).attr('max'))
                                send = false
                                return send
                            }

                            //HIDE SPAN ERRO
                            $('#span-' + $(this).data('usuario-campo')).css('display', 'none')
                            //ADD TO ARRAY
                            let campo = {
                                'usuarioCampoID': $(this).data('usuario-campo'),
                                'pontuacao': $(this).val() == 0 ? 0 : $(this).val()
                            }
                            pontuacoes.push(campo)
                            send = true
                        }
                    });
                    //SEND AJAX
                    if (send) {
                        $.ajax({
                            url: '{{route('pontuar.store')}}',
                            type: 'POST',
                            data: {
                                _token: '{{csrf_token()}}',
                                formularioUsuarioID: '{{$formularioUsuario->id}}',
                                pontuacoes: pontuacoes,
                            },
                            success: function (response) {
                                if (response.msg) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sucesso!',
                                        text: 'Avaliação realizada com sucesso!',
                                        type: 'success',
                                        confirmButtonText: 'OK',
                                        timer: 3000
                                    }).then(function () {
                                        window.location.href = '{{route('escolher.show', $formularioUsuario->formulario_id)}}'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro!',
                                        text: 'Ocorreu um erro ao realizar a avaliação!',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    })
                                }
                            },
                            error: function (response) {
                                let error = JSON.parse(response.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro!',
                                    text: error.error + (error.campo != undefined ? ' Campo inválido: ' + error.campo : '.'),
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        })
                    }
                } else {
                    //SWEET ALERT COM INPUT DE MOTIVO PARA REPROVAR
                    Swal.fire({
                        title: 'Motivo',
                        text: 'Digite o motivo para reprovar o formulário',
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Reprovar',
                        showLoaderOnConfirm: true,
                        preConfirm: (motivo) => {
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
                                        url: '{{route('reprovar.store')}}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{csrf_token()}}',
                                            formularioUsuarioID: '{{$formularioUsuario->id}}',
                                            motivo: motivo,
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
                                                window.location.href = '{{route('escolher.show', $formularioUsuario->formulario_id)}}'
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
                }
            })
        });
    </script>
@endpush
