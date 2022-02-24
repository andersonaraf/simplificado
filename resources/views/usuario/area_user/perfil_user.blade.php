@extends('layouts.header-footer')

@section('lista')
    <div class="container">
        <div class="py-4">
            <div class="card card-header bg-primary">
                <h5 class="text-white text-center">Perfil</h5>
            </div>

            <div class=" card card-body">
                <div class="col-12 col-md-12 col-sm-12 col-lg-12">
                    <div class=" justify-content-center">
                        <form method="POST" action="{{route('usuario.perfil.update')}}" class="form form-group">
                            @csrf
                            <label class="control-label">E-mail:</label>
                            <input class="form-control" name="email" type="text">
                            <br>
                            <label class="control-label" for="senha">Nova Senha:</label>
                            <input class="form-control " name="senha" type="text">
                            <br>
                            <label class="control-label" for="senha">Repetir Senha:</label>
                            <input class="form-control" name="senha" type="text">
<br>
                            <button class="btn btn-outline-dark" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>


@endsection
