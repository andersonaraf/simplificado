@extends('layouts.header-footer')

@section('content')
    <div class="container">
        <h4 class="mt-5">Formulário de Inscrição</h4>
        <form action="{{route('usuario.formulario.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name='formulario' value="{{$formulario_id}}">
            <input type="hidden" name='cargo' value="{{$cargo_id}}">
            @foreach($collapses as $collapse)
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="font-weight-bold text-white">{{$collapse->nome}}</h4>
                    </div>
                    <div class="card-body">
                        @foreach($collapse->campos as $campo)
                            <input type="hidden" name='input{{$campo->id}}' value="{{$campo->id}}">
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
