@component('mail::message')
<img height="100" src="{{asset('images/Brasão_de_Rio_Branco.svg.png')}}" alt="LOGO PREFEITURA" style="margin-left: 45%;">
<h1>Comprovante de Inscrição</h1>

<p>Olá {{$user->name}}, você se inscreveu no processo seletivo {{$formulario->nome}}.</p>
<p>{{date('d/m/Y H:i')}}</p>
<p>Comprovante: {{$comprovante->comprovante}}</p>
@component('mail::button', ['url' => env('APP_URL')])
Ver Incrição
@endcomponent
@endcomponent
