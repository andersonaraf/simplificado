@extends('layouts.header-footer')
@section('view_user')
    <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="my-5">
                <div class="d-flex justify-content-end pb-4">
                    <a href="{{route('usuario.lista.processos', Auth::user()->id)}}"><button type="button" class="btn btn-outline-primary">Voltar</button></a>
                </div>
                <div class="col-12 card card-header bg-primary ">
                    <div class="d-flex justify-content-center">
                        <img style="width:20em;"  src="{{asset('images/brancapref.png')}}">
                    </div>
                </div>
{{--                @dd($formularioUsuario)--}}
                <div class="card card-body">
                    <input type="text" value="">
                </div>
            </div>
        </div>
    </div>

@endsection
