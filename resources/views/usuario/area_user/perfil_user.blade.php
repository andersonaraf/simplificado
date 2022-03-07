@extends('layouts.header-footer')

@section('lista')
    <div class="container">
        <div class="py-4">
            <div class="card card-header bg-primary">
                <h5 class="text-white text-center">Alterar Acesso</h5>
            </div>

            <div class=" card card-body">
                <div class="col-12 col-md-12 col-sm-12 col-lg-12">
                    @if(session('msgerror'))
                        <span class="alert alert-danger">{{session('msgerror')}}</span>
                        {{session()->forget('msgerror')}}
                    @endif
                        @if(session('msg'))
                            <span class="alert alert-success">{{session('msg')}}</span>
                            {{session()->forget('msg')}}
                        @endif
                    <div class=" justify-content-center">
                        <form method="POST" action="{{route('usuario.perfil.update')}}" class="form form-group">
                            @csrf

                            <label class="control-label">Novo E-mail:</label>
                            <input class="form-control @error('email')is-invalid @enderror" name="email" type="text">
                            @error('email')
                            <span class=" my-4 alert alert-danger">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>

                            <label class="control-label" for="password">Nova Senha:</label>
                            <input class="form-control @error('password')is-invalid @enderror " name="password"
                                   type="password">
                            @error('password')
                            <span class=" my-4 alert alert-danger">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>

                            <label class="control-label" for="password">Repetir Senha:</label>
                            <input class="form-control @error('password2')is-invalid @enderror " name="password2"
                                   type="password">
                            @error('password2')
                            <span class=" my-4 alert alert-danger">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <button class="btn btn-outline-dark" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
