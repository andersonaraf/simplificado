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
        <div class="col-8 py-4">
            {{--ADCIONAR NOME DO USUÁRIO DINAMICAMENTE--}}
            <span class="alert alert-info">Bem Vindo! <b> {{Auth::user()->name}}</b></span>
        </div>
        <hr>
        @if(session('status'))
            <span class="alert alert-info">{{session('status')}}</span>
            {{session()->forget('status')}}
        @endif
       <div class="card-body">
            <nav class="row d-flex justify-content-end">
                <ul class="nav nav-tabs">
                    <li class="ml-5"><a href="{{route('home')}}">Home</a></li>
                    <li class="ml-5"><a href="{{route('usuario.perfil', auth()->user()->id)}}">Perfil Usuário</a></li>
                </ul>
            </nav>
        </div>
        {{--FUNCIONALIDADE DE BUSCAR TODOS OS PROCESSOS--}}

        {{--        <div class="row col-4">--}}
        {{--            <form></form>--}}
        {{--           <label class="label">Buscar CPF</label>--}}
        {{--           <input type="text" class="form-control" placeholder="Apenas Numeros">--}}
        {{--            <button type="button" class="btn btn-outline-primary">Buscar</button>--}}
        {{--        </div>--}}

        {{--BODY CARD--}}
        <div class="card card-body">
            <div class="row col-12 justify-content-center">
                <div class="col-6" style="text-align: center;">
                    <a href="{{route('usuario.lista.processos', Auth::user()->id)}}" class="text-white">
                        <div class="card py-4 bg-to-primary bg-primary">
                            <h6 class="text-white">
                                {{-- adcionar processos seletivos do usuário--}}
                                Meus Processos Seletivos
                            </h6>
                        </div>
                    </a>
                </div>
                <div class="col-6" style="text-align: center">
                    <a href="#" class="text-white">
                        <div class="card bg-to-primary  py-4  ">
                            <h6 class="text-white">
                                {{-- adcionar recursos--}}
                                Meus Recursos
                            </h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 py-4 " style="text-align: center">
                    <a href="{{ route('comprovante.index') }}" class="text-white">
                        <div class="card bg-to-primary py-4">
                            <h6 class="text-white">
                                {{-- adicionar rotas comprovantes--}}
                                Meus Comprovantes
                            </h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection

