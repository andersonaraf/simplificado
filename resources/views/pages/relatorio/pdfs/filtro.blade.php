<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RELATÓRIO COMPLETO</title>
    <link rel="stylesheet" href="{{public_path('css/app.css')}}">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <img src="{{public_path('images/logo-riobranco-hd.jpg')}}" alt="IMAGEM NÃO ENCONTRADA" width="100%">
    </div>
    <div class="row justify-content-center">
        <h2 class="text-center mt-3">RELATÓRIO COMPLETO</h2>
        <hr class="w-100">
    </div>

    {{--CARREGAR TABELA--}}
    <div class="row">

        <div class="col col-12 pl-0">
            <label class="w-100 font-weight-bold mb-0 ml-0">ESCOLARIDADE: <label
                    class="mb-0 pb-0 font-weight-normal">{{$cargo->escolaridade->nivel_escolaridade}}</label></label>
        </div>
        <div class="col col-9">
            <label class="font-weight-normal"></label>
        </div>
        <div class="col col-3 pl-0">
            <label class="w-100 font-weight-bold mb-0 ml-0">CARGO: <label
                    class="font-weight-normal">{{$cargo->cargo}}</label></label>
        </div>
        <hr class="w-100 mt-0">
        <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
            <thead>
            <tr>
                <th>NOME COMPLETO</th>
                <th>CPF</th>
                <th>DATA DE NASCIMENTO</th>
                <th class="text-right">STATUS</th>
                <th class="text-right">PONTUAÇÃO</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cargo->formularioUsuario as $formularioUsuario)
                <tr>
                    <td>{{mb_strtoupper($formularioUsuario->user->name)}}</td>
                    <td>{{!is_null($formularioUsuario->user->pessoa) ? $formularioUsuario->user->pessoa->cpf : 'NÃO INFORMADO'}}</td>
                    <td>
                        {{!is_null($formularioUsuario->user->pessoa) ? date('d/m/Y', strtotime($formularioUsuario->user->pessoa->data_nascimento)) : 'NÃO INFORMADO'}}
                    </td>
                    <td class="text-right">
                        @if($formularioUsuario->avaliado == 1 && $formularioUsuario->revisado == 1)
                            APROVADO
                        @elseif($formularioUsuario->avaliado == 0 && $formularioUsuario->revisado == 0)
                            REPROVADO
                        @else
                            EM ANÁLISE
                        @endif
                    </td>
                    <td class="text-right">{{$formularioUsuario->pontuacao_total}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>NOME COMPLETO</th>
                <th>CPF</th>
                <th>DATA DE NASCIMENTO</th>
                <th class="text-right">STATUS</th>
                <th class="text-right">PONTUAÇÃO</th>
            </tr>
            </tfoot>
        </table>
        <hr class="w-100 mt-0">
    </div>
</div>
</body>
</html>
