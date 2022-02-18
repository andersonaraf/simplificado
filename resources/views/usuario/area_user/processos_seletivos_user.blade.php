@extends('layouts.header-footer')
@section('lista')

    {{--    VERIFICA SE O USUÁRIO ESTÁ PARTICIPANDO DE ALGUM PROESSO SELETIVO--}}
    @if(isset($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="card-header">
                    <h5>titulo</h5>

                    <div class=" card card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Processo</th>
                                <th>Cargo</th>
                                <th>acoes</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td>TESTE</td>
                                <td>TESTE</td>
                                <td><button type="button" class="btn btn-success">Visualizar</button></td>
                                <td><button type="button" class="btn">ddad</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif




    {{--    TELA QUANDO USUÁRIO NAO SE ESCREVEU EM NENHUM PROCESSO SELETIVO--}}
    @if(is_null($formularioUsuario))
        <div class="container">
            <h1>Não possui processos</h1>
        </div>

    @endif
@endsection
