<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <div style="text-align: center; margin-top: 2%;">
        <img src="{{public_path().'/images/logo_emurb.jpg'}}"/>
    </div>
    <div style="margin-left: 20%;">
        <h2>Nome: {{$comprovante->pessoa->nome_completo}}</h2>
        <h2>Cargo: {{$comprovante->pessoa->cargo->cargo}}</h2>
        <h2>Data de Inscrição: {{date('Y-m-d H:i:s', strtotime($comprovante->pessoa->created_at))}}</h2>
        <h2>Número de Protocolo: {{$comprovante->comprovante}}</h2>
    </div>
    <div style="margin-top: 30%; text-align: center">
        <strong>Prefeitura de Rio Branco</strong>
    </div>
</body>
</html>
