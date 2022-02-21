@extends('layouts.header-footer')
@section('lista')

    {{--    VERIFICA SE O USUÁRIO ESTÁ PARTICIPANDO DE ALGUM PROESSO SELETIVO--}}
    @if(isset($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="col- 12 col-md-12 col-lg-12 col-sm-12 card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-sm-12 card card-body">
                    {{--                    @dd($formularioUsuario)--}}
                    <table class="col-sm-12 table-bordered table table-responsive-lg table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Processo</th>
                            <th>Cargo</th>
                            <th>Data Inscrição</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-striped">
                            <td>{{ $formulario->nome}}</td>
                            <td>{{$cargo->cargo}}</td>
                            <td>{{date('d/m/Y',strtotime($formularioUsuario->created_at)  )}}</td>
                            <td><a href="{{route('usuario.view.processos', Auth::user()->id)}}">
                                    <button type="button" class="btn btn-info">Vizualizar</button>
                                </a>
                                @if($recurso_hability == true)
                                    <a href="{{route('usuario.recurso')}}">
                                        <button type="button" class="btn btn-warning">Recurso</button>
                                    </a>
                                @else
                                    <a onclick="mensagem()" >
                                        <button type="button" class="btn btn-warning" disabled> Recurso
                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div  id="mensagem">
{{--                        MENSAGEM DE ALERTA AQUI AO CLICKAR NO NO BOTÃO DE RECURSO, INFORMANDO USUÁRIO!--}}
                    </div>

                </div>
            </div>
        </div>
        </div>
    @endif




    {{--    TELA QUANDO USUÁRIO NAO SE ESCREVEU EM NENHUM PROCESSO SELETIVO--}}
    @if(is_null($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-sm-12 card card-body ">
                    <div class="d-flex  justify-content-center">
                        <h4 class="">Voçê ainda não se inscreveu em nenhum processo seletivo</h4>
                    </div>

                </div>
            </div>

        </div>

    @endif
@endsection
