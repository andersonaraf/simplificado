@extends('layouts.app', [ 'activePage' => 'cadastrar', 'titlePage' => __('Usuário')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">Lista de Formulários</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <form action="{{route('usuario.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-md-6 col-lg-6">
                                                <label class="text-info" for="name">Nome</label>
                                                <input type="text" name="name" class="form-control" id="name">
                                            </div>

                                            <div class="col col-md-6 col-lg-6">
                                                <label class="text-info" for="email">E-mail</label>
                                                <input type="email" name="email" class="form-control" id="email">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col col-md-6 col-lg-6">
                                                <label class="text-info" for="password">Senha</label>
                                                <input type="password" class="form-control" name="password"
                                                       id="password">
                                            </div>

                                            <div class="col col-md-6 col-lg-6">
                                                <label class="text-info" for="password2">Repetir a senha</label>
                                                <input type="password" class="form-control" name="password2" id="password2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col col-md-6 col-lg-6">
                                                <label class="text-info" for="tipo">Tipo de usuário</label>
                                                <select name="tipo" id="tipo" class="form-control">
                                                    <option value="Avaliador">Avaliador</option>
                                                    <option value="Revisor">Revisor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button class="btn btn-outline-info">Cadastrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
