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
                    inputs.map(function (index, element) {
                        if ($(this).data('usuario-campo') != undefined || $(this).data('usuario-campo') != null) {
                            //VALIDATE MAX
                            if ($(this).val() > $(this).attr('max')) {
                                //SHOW SPAN ERRO
                                $('#span-' + $(this).data('usuario-campo')).css('display', 'block')
                                $('#error-' + $(this).data('usuario-campo')).text('Valor máximo de ' + $(this).attr('max'))
                                return false;
                            }
                            //VALIDATE DATA REQURIED
                            if ($(this).data('required') == 1 && ($(this).val() == '' || $(this).val() == null)) {
                                //SHOW SPAN ERRO
                                $('#span-' + $(this).data('usuario-campo')).css('display', 'block')
                                $('#error-' + $(this).data('usuario-campo')).text('Campo obrigatório')
                                return false;
                            }

                            //HIDE SPAN ERRO
                            $('#span-' + $(this).data('usuario-campo')).css('display', 'none')
                            //ADD TO ARRAY
                            let campo = {
                                'usuarioCampoID': $(this).data('usuario-campo'),
                                'pontuacao': $(this).val() == 0 ? 0 : $(this).val()
                            }
                            pontuacoes.push(campo)

                        }
                    });
                    console.log(pontuacoes)
                    //SEND AJAX
                    $.ajax({
                        url: '{{route('candidato.store')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            formularioUsuarioID: '{{$formulariUsuario->id}}',
                            pontuacoes: pontuacoes,
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Sucesso!',
                                    text: 'Avaliação realizada com sucesso!',
                                    type: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function () {
{{--                                    window.location.href = '{{route('avaliacao.candidato.index')}}'--}}
                                })
                            } else {
                                Swal.fire({
                                    title: 'Erro!',
                                    text: 'Ocorreu um erro ao realizar a avaliação!',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    })
                }
            })
        });
    </script>
@endpush
