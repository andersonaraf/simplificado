@extends('layouts.header-footer')
<style>
    .bg-to-primary {
        background-color: #007bff !important;
    }

    .bg-to-primary:hover {
        background-color: rgba(30, 30, 30, 0.9) !important;
    }
</style>
@section('user')
    <div class="container">
        {{--DIV NOME DO USUARIO--}}
        <div class="col-4 py-4">
            {{--ADCIONAR NOME DO USUÁRIO DINAMICAMENTE--}}
            <span class="alert alert-info">Bem Vindo! <b> José Gabriel</b></span>
        </div>
        <hr>
        @if(session('status'))
        <span class="alert alert-info">{{session('status')}}</span>

        @endif
        <nav class="row d-flex justify-content-end">
            <ul class="nav nav-tabs">
                <li class="ml-5"><a href="#">Home</a></li>
                <li class="ml-5"><a href="#">Perfil Usuário</a></li>
                <li class="ml-5"><a href="#">Voltar</a></li>
            </ul>
        </nav>
        {{--BODY CARD--}}
        <div class="card card-body">
            <div class="row col-12 justify-content-center">
                <div class="col-6" style="text-align: center;">
                    <div class="card py-4 bg-to-primary bg-primary">
                        <h6 class="text-white">
                            {{-- adcionar processos seletivos do usuário--}}
                            <a href="#" class="text-white">Meus Processos Seletivos</a>
                        </h6>
                    </div>
                </div>
                <div class="col-6" style="text-align: center">
                    <div class="card bg-to-primary  py-4  ">
                        <h6 class="text-white">
                            {{-- adcionar recursos--}}
                            <a href="#" class="text-white">Meus Recursos</a>
                        </h6>
                    </div>
                </div>
                <div class="col-6 py-4 " style="text-align: center">
                    <div class="card bg-to-primary py-4">
                        <h6 class="text-white">
                            {{-- adicionar rotas comprovantes--}}
                            <a href="#" class="text-white">Meus Comprovantes</a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection

