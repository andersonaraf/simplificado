@extends('layouts.header-footer')
@section('lista')

    {{--    VERIFICA SE O USUÁRIO ESTÁ PARTICIPANDO DE ALGUM PROESSO SELETIVO--}}
    @if(isset($formularioUsuario))
        <div class="container">
            <div class="py-5">
                <div class="card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>
                <div class=" card card-body">
                    <table class="table  table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr class="">
                            <th>Processo</th>
                            <th>Cargo</th>
                            <th>Data</th>
                            <th>acoes</th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr class="table-light">
                            <td>TESTE</td>
                            <td>TESTE</td>
                            <td>11/12/30</td>
                            <td><a href="{{route('inicio')}}">
                                    <button type="button" class="btn btn-success">Vizualizar</button>
                                </a></td>
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
            <div class="py-5">
                <div class="card card-header bg-primary py-4">
                    {{--APENAS DIV ESTETICA PARA LAYOUT--}}
                </div>

            </div>
            <h1>Não possui processos</h1>
        </div>

    @endif
@endsection
