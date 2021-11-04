@php
    ini_set('memory_limit', '1024M');
    set_time_limit('3600');
@endphp
    <!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo}}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
        }

        table td {
            text-align: center;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }


        .invoice h3 {
            margin-left: 15px;
        }

        .information {
            background-color: #0E3594;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }

        #container {
            width: 100%;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="center">
                <figure id="container">
                    <img src="https://processoseletivosemsa20212.riobranco.ac.gov.br/images/caruosel/2-1634561848.png" width="90%"/>
                </figure>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>{{$titulo}}</h3>
    <table width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Escolaridade</th>
            <th>Pontuação Publica</th>
            <th>Pontuacação Privada</th>
            <th>PNE</th>
            <th>Pontuação</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        {{$i= 1}}
        {{--        PNE--}}
        @if(isset($pessoasPNE) && count($pessoasPNE) > 0)
            <tr>
                <td colspan="10" style="font-weight: bold;">
                    <hr>
                    <label style="font-size: 16px; margin-top: -2px">PCD</label>
                    <hr>
                </td>
            </tr>
            @foreach($pessoasPNE as $key => $pessoaPNE)
                @if($pessoaPNE->pessoaEditalAnexos->count() != 0)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$pessoaPNE->nome_completo}}</td>
                        <td>{{$pessoaPNE->cpf}}</td>
                        <td>{{$pessoaPNE->cargo->cargo}}</td>
                        <td>{{$pessoaPNE->escolaridade->nivel_escolaridade}}</td>
                        @if($pessoaPNE->status_avaliado == 0 && $pessoaPNE->status == 0 && $pessoaPNE->status_revisado == 0)
                            <td>0</td>
                            <td>0</td>
                        @else
                            <td>{{$pessoaPNE->pontuacao($pessoaPNE->id)->pontuacao_total_publica}}</td>
                            <td>{{$pessoaPNE->pontuacao($pessoaPNE->id)->pontuacao_total_privada}}</td>
                        @endif
                        @if ($pessoaPNE->portador_deficiencia == 1)
                            <td style="font-weight: bold">SIM</td>
                        @else
                            <td>NÃO</td>
                        @endif
                        @if($pessoaPNE->status_avaliado == 0 && $pessoaPNE->status == 0 && $pessoaPNE->status_revisado == 0)
                            <td>0</td>
                        @else
                            <td>{{$pessoaPNE->pontuacao($pessoaPNE->id)->pontuacao_total}}</td>
                        @endif
                        @if(is_null($pessoaPNE->status_avaliado))
                            <td class="text-warning">Aguardando Avaliação</td>
                        @elseif(!is_null($pessoaPNE->status_avaliado) && is_null($pessoaPNE->status) && is_null($pessoaPNE->status_revisado))
                            <td class="text-warning">Aguardando Revisão</td>
                        @elseif(!is_null($pessoaPNE->status_avaliado) && is_null($pessoaPNE->status) && $pessoaPNE->status_revisado == 0)
                            <td class="text-warning">Aguardando Reavaliação</td>
                        @elseif($pessoaPNE->status_avaliado == 1 && $pessoaPNE->status == 1 && $pessoaPNE->status_revisado == 1)
                            <td class="text-success">Aprovado</td>
                        @elseif($pessoaPNE->status_avaliado == 0 && $pessoaPNE->status == 0 && $pessoaPNE->status_revisado == 0)
                            <td class="text-danger">Reprovado</td>
                        @elseif(is_null($pessoaPNE->status_avaliado) || is_null($pessoaPNE->status) || is_null($pessoaPNE->status_revisado) || ($pessoaPNE->status_avaliado)==0 || ($pessoaPNE->status)==0 || ($pessoaPNE->status_revisado)==0)
                            <td class="text-info">Solicite Suporte Avaliação Incorreta</td>
                        @endif
                    </tr>
                    {{$i++}}

                @endif
            @endforeach
            <tr>
                <td colspan="10" style="font-weight: bold;">
                    <hr>
                    <label style="font-size: 16px; margin-top: -2px">* * *</label>
                    <hr>
                </td>
            </tr>
        @endif
        {{--        NORMAL--}}

        {{$i = 1}}
        @foreach($pessoas as $key => $pessoa)
            @if($pessoa->pessoaEditalAnexos->count() != 0)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$pessoa->nome_completo}}</td>
                    <td>{{$pessoa->cpf}}</td>
                    <td>{{$pessoa->cargo->cargo}}</td>
                    <td>{{$pessoa->escolaridade->nivel_escolaridade}}</td>
                    @if($pessoa->status_avaliado == 0 && $pessoa->status == 0 && $pessoa->status_revisado == 0)
                        <td>0</td>
                        <td>0</td>
                    @else
                        <td>{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_publica}}</td>
                        <td>{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_privada}}</td>
                    @endif
                    @if ($pessoa->portador_deficiencia == 1)
                        <td style="font-weight: bold">SIM</td>
                    @else
                        <td>NÃO</td>
                    @endif
                    @if($pessoa->status_avaliado == 0 && $pessoa->status == 0 && $pessoa->status_revisado == 0)
                        <td>0</td>
                    @else
                        <td>{{$pessoa->pontuacao($pessoa->id)->pontuacao_total}}</td>
                    @endif
                    @if(is_null($pessoa->status_avaliado))
                        <td class="text-warning">Aguardando Avaliação</td>
                    @elseif(!is_null($pessoa->status_avaliado) && is_null($pessoa->status) && is_null($pessoa->status_revisado))
                        <td class="text-warning">Aguardando Revisão</td>
                    @elseif(!is_null($pessoa->status_avaliado) && is_null($pessoa->status) && $pessoa->status_revisado == 0)
                        <td class="text-warning">Aguardando Reavaliação</td>
                    @elseif($pessoa->status_avaliado == 1 && $pessoa->status == 1 && $pessoa->status_revisado == 1)
                        <td class="text-success">Aprovado</td>
                    @elseif($pessoa->status_avaliado == 0 && $pessoa->status == 0 && $pessoa->status_revisado == 0)
                        <td class="text-danger">Reprovado</td>
                    @elseif(is_null($pessoa->status_avaliado) || is_null($pessoa->status) || is_null($pessoa->status_revisado) || ($pessoa->status_avaliado)==0 || ($pessoa->status)==0 || ($pessoa->status_revisado)==0)
                        <td class="text-info">Solicite Suporte Avaliação Incorreta</td>
                    @endif
                </tr>
                {{$i++}}
            @endif
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Escolaridade</th>
            <th>Pontuação Publica</th>
            <th>Pontuacação Privada</th>
            <th>PNE</th>
            <th>Pontuação</th>
            <th>Status</th>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ 'https://processoseletivoseinfra2021.riobranco.ac.gov.br/' }} - Todos os direitos reservados.
            </td>
            <td align="right" style="width: 50%;">
                Processo Seletivo Simplificado
            </td>
        </tr>

    </table>
</div>
</body>
</html>
