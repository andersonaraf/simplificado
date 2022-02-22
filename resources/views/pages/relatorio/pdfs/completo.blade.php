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
        @foreach($formulario->escolaridades as $escolaridade)
            <div class="col col-12 pl-0">
                <label class="w-100 font-weight-bold mb-0 ml-0">ESCOLARIDADE: <label class="mb-0 pb-0 font-weight-normal">{{$escolaridade->nivel_escolaridade}}</label></label>
            </div>
            <div class="col col-9">
                <label class="font-weight-normal"></label>
            </div>
            @foreach($escolaridade->cargos as $cargo)
                <div class="col col-3 pl-0">
                    <label class="w-100 font-weight-bold mb-0 ml-0">CARGO: <label class="font-weight-normal">{{$cargo->cargo}}</label></label>
                </div>
                <hr class="w-100 mt-0">
                <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                    <thead>
                    <tr>
                        <th>NOME COMPLETO</th>
                        <th>CPF</th>
                        <th class="text-right">DATA DE NASCIMENTO</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cargo->formularioUsuario as $formularioUsuario)
                        <tr>
                            <td>{{mb_strtoupper($formularioUsuario->user->name)}}</td>
                            <td>{{!is_null($formularioUsuario->user->pessoa) ? $formularioUsuario->user->pessoa->cpf : 'NÃO INFORMADO'}}</td>
                            <td class="text-right">
                                {{!is_null($formularioUsuario->user->pessoa) ? date('d/m/Y', strtotime($formularioUsuario->user->pessoa->data_nascimento)) : 'NÃO INFORMADO'}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>NOME COMPLETO</th>
                        <th>CPF</th>
                        <th class="text-right">DATA DE NASCIMENTO</th>
                    </tr>
                    </tfoot>
                </table>
                <hr class="w-100 mt-0">
            @endforeach
        @endforeach
    </div>
</div>
</body>
</html>
