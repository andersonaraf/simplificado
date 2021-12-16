@extends('layouts.header-footer')
@section('title')
    <title>Processo Seletvo Simplificado - REGISTRO</title>
@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('css/registro/modal-confirmacao.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
@endsection

@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <hr>
                <h3>Cadastro Simplificado</h3>
                <hr>
            </div>
            <div id="accordion" style="width: 100%">
                <form id="formulario_registro" method="post" action="{{route('registro/parte1')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-dark-blue set-pointer" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                             aria-controls="collapseOne">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold" value="DADOS PESSOAIS">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="nomeCompleto">Nome Completo:</label>
                                            <input type="text" class="form-control" name="nomeCompleto" id="nomeCompleto" placeholder="Informe seu nome">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <label for="nomeSocial">Nome social:</label>
                                        <input type="text" class="form-control" name="nomeSocial" id="nomeSocial" placeholder="Nome social">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="cpf">CPF:</label>
                                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="000.000.000-00">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="rg">RG:</label>
                                            <input type="text" class="form-control" name="rg" id="rg" placeholder="12345678">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="orgaoExpedidor">Órgão Expedidor:</label>
                                            <input type="text" class="form-control" name="orgaoExpedidor" id="orgaoExpedidor" placeholder="SSP-AC">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="contato1">Telefone ou Celular (1):</label>
                                            <input type="text" class="form-control" name="contato1" id="contato1" placeholder="(68) 99999-9999">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="contato2">Telefone ou Celular (2):</label>
                                            <input type="text" class="form-control" name="contato2" id="contato2" placeholder="(68) 99999-9999">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="genero">Gênero:</label>
                                            <select class="custom-select" name="genero" id="genero">
                                                <option value="">Não Selecionado</option>
                                                @foreach($generos as $genero)
                                                    <option value="{{$genero->id}}">{{$genero->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="pne">PNE - Portador de Necessidades Especiais:</label>
                                            <select class="custom-select" name="pne" id="pne">
                                                <option value="">Não Selecionado</option>
                                                <option value="1">SIM</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    ENDEREÇO--}}
                    <div class="card">
                        <div class="card-header text-center bg-dark-blue set-pointer" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link collapsed text-white font-weight-bold" value="ENDEREÇO">
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse multi-collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="cep" class="font-weight-bold">CEP:</label>
                                            <input type="cep" class="form-control" id="cep" name="cep" placeholder="69.900-631">
                                        </div>
                                    </div>
                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="bairro" class="font-weight-bold">Bairro:</label>
                                            <input type="bairro" class="form-control" id="bairro" name="bairro" placeholder="Bairro Bosque">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep" class="font-weight-bold">Rua:</label>
                                            <input type="cep" class="form-control" id="cep" name="cep" placeholder="Rua Alvorada">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="numero" class="font-weight-bold">Número:</label>
                                            <input type="number" class="form-control" id="numero" name="numero" placeholder="411">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="complemento" class="font-weight-bold">Complemento:</label>
                                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="2º Piso">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--USUARIO--}}
                    <div class="card">
                        <div class="card-header text-center bg-dark-blue set-pointer" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                             aria-controls="collapseThree">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link collapsed text-white font-weight-bold" value="USUÁRIO">
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse multi-collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-12 col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold">Endereço de Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="rb_simplificado@riobranco.ac.gov.br">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="font-weight-bold">Senha:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="********">
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="passwordCheck" class="font-weight-bold">Confirma Senha:</label>
                                            <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="********">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-info font-weight-bold" value="Cadastrar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection


@section('script')

@endsection
