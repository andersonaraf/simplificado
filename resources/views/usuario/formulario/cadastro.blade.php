@extends('layouts.header-footer')

@section('content')
    <div class="container">
        <h4 class="mt-5">Formulário de Inscrição</h4>
        <form action="#" method="post">
            @csrf
            @foreach($collapses as $collapse)
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="font-weight-bold text-white">{{$collapse->nome}}</h4>
                    </div>
                    <div class="card-body">
                        @foreach($collapse->campos as $campo)
                            @include('usuario.formulario.tipoCampo')
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-lg mt-2 ">Cadastrar</button>
            </div>
        </form>
    </div>
@endsection
