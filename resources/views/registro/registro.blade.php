@extends('layouts.header-footer')
@section('title')
    <title>Processo Seletvo Simplificado - REGISTRO</title>
@endsection


        <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/registro/modal-confirmacao.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">

@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <hr>
                <h3>Cadastro Simplificado</h3>
                <hr>
            </div>
            <div id="accordion" style="width: 100%">
                <form id="formulario_registro" method="post" action="{{route('cadastro-simplificado.store')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-primary set-pointer" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
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
                                            <input type="text" class="form-control" name="nomeCompleto" id="nomeCompleto" placeholder="Informe seu nome" value="{{$errors->has('nomeCompleto') ? '' : old('nomeCompleto')}}">
                                            @error('nomeCompleto')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <label for="nomeSocial">Nome social:</label>
                                        <input type="text" class="form-control" name="nomeSocial" id="nomeSocial" placeholder="Nome social" value="{{$errors->has('nomeSocial') ? '' : old('nomeSocial')}}">
                                        @error('nomeSocial')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="cpf">CPF:</label>
                                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="000.000.000-00" value="{{$errors->has('cpf') ? '' : old('cpf')}}">
                                            @error('cpf')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="rg">RG:</label>
                                            <input type="text" class="form-control" name="rg" id="rg" placeholder="12345678" value="{{$errors->has('rg') ? '' : old('rg')}}">
                                            @error('rg')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="orgaoExpedidor">Órgão Expedidor:</label>
                                            <input type="text" class="form-control" name="orgaoExpedidor" id="orgaoExpedidor" placeholder="SSP-AC" value="{{$errors->has('orgaoExpedidor') ? '' : old('orgaoExpedidor')}}">
                                            @error('orgaoExpedidor')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="contato1">Telefone ou Celular (1):</label>
                                            <input type="text" class="form-control" name="contato1" id="contato1" placeholder="(68) 99999-9999" value="{{$errors->has('contato1') ? '' : old('contato1')}}">
                                            @error('contato1')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="contato2">Telefone ou Celular (2):</label>
                                            <input type="text" class="form-control" name="contato2" id="contato2" placeholder="(68) 99999-9999" value="{{$errors->has('contato2') ? '' : old('contato2')}}">
                                            @error('contato2')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="genero">Gênero:</label>
                                            <select class="custom-select" name="genero" id="genero">
                                                <option value="">Não Selecionado</option>
                                                @foreach($generos as $genero)
                                                    <option value="{{$genero->id}}" {{old('genero') == $genero->id ? ($errors->has('contato2') ? '' : 'selected') : ''}}>{{$genero->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('genero')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="pne">PNE - Portador de Necessidades Especiais:</label>
                                            <select class="custom-select" name="pne" id="pne">
                                                <option value="">Não Selecionado</option>
                                                <option value="1" {{old('pne') == 1 ? ($errors->has('pne') ? '' : 'selected') : ''}}>SIM</option>
                                                <option value="0" {{old('pne') == 0 ? ($errors->has('pne') ? '' : 'selected') : ''}}>Não</option>
                                            </select>
                                            @error('pne')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    ENDEREÇO--}}
                    <div class="card">
                        <div class="card-header text-center bg-primary set-pointer" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                             aria-controls="collapseTwo">
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
                                            <input type="text" class="form-control" id="cep" name="cep" placeholder="99999-999" value="{{$errors->has('cep') ? '' : old('cep')}}">
                                            @error('cep')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="bairro" class="font-weight-bold">Bairro:</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro Bosque" value="{{$errors->has('bairro') ? '' : old('bairro')}}">
                                            @error('bairro')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="rua" class="font-weight-bold">Rua:</label>
                                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua Alvorada" value="{{$errors->has('rua') ? '' : old('rua')}}">
                                            @error('rua')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="numero" class="font-weight-bold">Número:</label>
                                            <input type="number" class="form-control" id="numero" name="numero" placeholder="411" value="{{$errors->has('numero') ? '' : old('numero')}}">
                                            @error('numero')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="complemento" class="font-weight-bold">Complemento:</label>
                                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="2º Piso" value="{{$errors->has('complemento') ? '' : old('complemento')}}">
                                            @error('complemento')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--USUARIO--}}
                    <div class="card">
                        <div class="card-header text-center bg-primary set-pointer" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
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
                                            <input type="email" class="form-control" id="email" name="email" placeholder="rb_simplificado@riobranco.ac.gov.br" value="{{$errors->has('email') ? '' : old('email')}}">
                                            @error('email')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="font-weight-bold">Senha:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="********">
                                            @error('password')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="font-weight-bold">Confirma Senha:</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="********">
                                            @error('password_confirmation')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-dark font-weight-bold" value="Cadastrar">
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
