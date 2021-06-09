@extends('layouts.header-footer')
@section('title')
    <title>SEINFRA - REGISTRO</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/modal-confirmacao.css')}}">
@endsection

@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <form id="formulario_registro" method="post" action="{{route('registro/parte1')}}">
                <input type="text" name="type_edital" value="{{$id}}" hidden>
                @csrf
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    {{session()->forget('error')}}
                @endif
                <ul id="progress">
                    <li class="ativo">Dados Pessoais</li>
                    <li>Endereço</li>
                    <li>Cargo</li>
                </ul>

                <fieldset>
                    <h2>Dados Pessoais</h2>

                    <input type="text" name="nome_completo" id="nome_completo" autocomplete="nome_completo"
                           value="{{old('nome_completo')}}"
                           class="@error('nome_completo') is-invalid @enderror form-control"
                           placeholder="Informe seu Nome Completo"
                           autofocus/>
                    @error('nome_completo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="cpf" id="cpf" autocomplete="cpf" value="{{old('cpf')}}"
                           class="@error('cpf') is-invalid @enderror form-control" placeholder="Informe seu CPF"/>
                    @error('cpf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="rg" id="rg" autocomplete="rg" value="{{old('rg')}}"
                           class="@error('rg') is-invalid @enderror form-control ajuseLeft"
                           placeholder="Informe seu RG"/>
                    <input type="text" name="orgao_emissor" id="orgao_emissor" autocomplete="orgao_emissor"
                           value="{{old('orgao_emissor')}}"
                           class="@error('orgao_emissor') is-invalid @enderror form-control ajusteRight"
                           placeholder="Orgão Emissor"/>
                    @error('rg')
                    <div class="alert alert-danger" style="width: 40%;display: inline-block;">{{ $message }}</div>
                    @enderror
                    @error('orgao_emissor')
                    <div class="alert alert-danger" style="width: 40%;display: inline-block;">{{ $message }}</div>
                    @enderror

                    <input type="text" id="telefone" name="telefone" autocomplete="telefone" value="{{old('telefone')}}"
                           class="@error('telefone') is-invalid @enderror form-control"
                           placeholder="Informe seu Telefone"/>
                    @error('telefone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="nacionalidade" id="nacionalidade" autocomplete="nacionalidade"
                           value="{{old('nacionalidade')}}"
                           class="@error('nacionalidade') is-invalid @enderror form-control"
                           placeholder="Informe sua Nacionalidade"/>
                    @error('nacionalidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="naturalidade" id="naturalidade" autocomplete="naturalidade"
                           value="{{old('naturalidade')}}"
                           class="@error('naturalidade') is-invalid @enderror form-control"
                           placeholder="Informe sua Naturalidade"/>
                    @error('naturalidade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="email" name="email" id="email" autocomplete="email" value="{{old('email')}}"
                           class="@error('email') is-invalid @enderror form-control" placeholder="Informe seu Email"/>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="email" name="email_confirmation" id="email_confirmation"
                           autocomplete="email_confirmation" value="{{old('email_confirmation')}}"
                           class="@error('email') is-invalid @enderror form-control" placeholder="Confirme seu Email"/>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>Data de Nascimento</p>
                    <input type="date" name="data_nascimento" max="2004-12-31" id="data_nascimento"
                           autocomplete="data_nascimento" value="{{old('data_nascimento')}}"
                           class="@error('data_nascimento') is-invalid @enderror form-control"/>
                    @error('data_nascimento')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>Sexo</p>
                    <select class="@error('sexo') is-invalid @enderror form-control" name="sexo" id="sexo">
                        <option value="H">Masculino</option>
                        <option value="M">Feminino</option>
                    </select>
                    @error('sexo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>PNE - Portador de Necessidades Especiais</p>
                    <select name="deficiencia" class="@error('deficiencia') is-invalid @enderror form-control" id="pne">
                        <option value="Sim">Sim</option>
                        <option value="Nao" selected>Nao</option>
                    </select>
                    @error('deficiencia')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                </fieldset>

                <fieldset>

                    <h2>Endereço</h2>
                    <input type="text" name="cep" id="cep" autocomplete="cep" value="{{old('cep')}}"
                           class="@error('cep') is-invalid @enderror form-control" placeholder="Informe seu CEP"/>
                    @error('cep')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <span class="help-block"></span>
                    <input type="text" name="bairro" id="bairro" autocomplete="bairro" value="{{old('bairro')}}"
                           class="@error('bairro') is-invalid @enderror form-control" placeholder="Informe seu Bairro"/>
                    @error('bairro')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="endereco" id="endereco" autocomplete="endereco" value="{{old('endereco')}}"
                           class="@error('endereco') is-invalid @enderror form-control"
                           placeholder="Informe seu Endereço/UF"/>
                    @error('endereco')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="number" name="numero" min="0" id="numero" autocomplete="numero"
                           value="{{old('numero')}}" class="@error('numero') is-invalid @enderror form-control"
                           placeholder="Informe o número"/>
                    @error('numero')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="button" name="next" id="next" class="next acao" value="Proximo"/>
                    <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>

                </fieldset>

                <fieldset>
                    <h2>Cargo</h2>
                    <h3>Selecione sua Escolaridade</h3>


                    <select name="escolaridade" id="escolaridade">
                        <option value="">Não selecionado</option>
                        @foreach($editalDinamico->escolaridadeEditalDinamico as $escolariadeEditalDinamico)
                            <option
                                value="{{$escolariadeEditalDinamico->escolaridade->id}}">{{$escolariadeEditalDinamico->escolaridade->nivel_escolaridade}}</option>
                        @endforeach
                    </select>
                    @error('escolaridade')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div hidden id="cargo-div">
                        <h3>Selecione seu Cargo</h3>
                        <select name="CARGO" class="cargos" id="cargo">
                            <option value="0">Não selecionado</option>
                            @foreach($cargos as $cargo)
                                <option data-escolaridade="{{$cargo->escolaridade->id}}"
                                        value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" name="termo_de_condicao" required>
                            </div>
                            <div class="col-8">
                                <label>Usuário está ciente de que
                                    fornece informação de forma consciente e voluntária por meio do formulário.
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" name="termo_de_privacidade" required>
                            </div>
                            <div class="col-8">
                                <label>Declaro que aceito todas as exigências especificadas no Edital de abertura deste
                                    Processo Seletivo, bem
                                    como serem verdadeiras todas as informações aqui prestadas e estou ciente que
                                    qualquer falsa alegação ou
                                    omissão de informações conforme disposto no edital, implicará em minha exclusão do
                                    processo seletivo,
                                    sujeitando-me, ainda, às penas da lei. Declaro que estar instruído esta ficha de
                                    inscrição com cópias legíveis,
                                    estando ciente em minha desclassificação, caso não esteja.</label>
                            </div>
                        </div>
                    </div>
                    @error('CARGO')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="button" name="next" id="confirma" class="acao" value="Enviar"/>
                    <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                </fieldset>

                <!-- MODAL DE CONFIRMACAO -->
                <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: none">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Confirmação de Dados</h2>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row">
                                    <h5>Dados Pessoais</h5>
                                    <div class="col col-12">
                                        <p>Nome:
                                            <labe id="nome_conf"></labe>
                                        </p>
                                    </div>
                                    <div class="col col-12">
                                        <p>CPF <label id="cpf_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>RG: <label id="rg_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Orgão Emissor: <label id="orgao_emissor_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Telefone: <label id="telefone_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Nacionalidade: <label id="nacionalidade_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Naturalide: <label id="naturalidade_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Email: <label id="email_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Data Nascimento: <label id="data_nascimento_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Sexo: <label id="sexo_conf"></label></p>
                                    </div>
                                    <div class="col col-6">
                                        <p>PNE: <label id="pne_conf"></label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5>Endereço</h5>
                                    <div class="col col-12">
                                        <p>CEP: <label id="cep_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Bairro: <label id="bairro_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Endereco: <label id="endereco_conf"></label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5>Escolaridade</h5>
                                    <div class="col col-12">
                                        <p>Nível de Escolaridade: <label id="escolaridade_conf"></label></p>
                                    </div>
                                    <div class="col col-12">
                                        <p>Cargo: <label id="cargo_conf"></label></p>
                                    </div>
                                </div>
                                <div class="card bg-danger" id="data_nascimento_error" hidden>
                                    <b style="color: white">Você não está apto a realizar a inscrição. Idade mínima para
                                        o ato da contratação 18 anos.</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">
                                        Fechar
                                    </button>
                                    <button type="submit" class="btn btn-secondary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </main>
@endsection


@section('script')
    <script src="{{asset('js/registro/function.js')}}"></script>
    <script src="{{asset('js/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('js/registro/mask.js')}}"></script>
    <script src="{{asset('js/registro/confirmacao.js')}}"></script>
    <script src="{{asset('js/registro/cep.js')}}"></script>
    <script src="{{asset('assets/moment.js')}}"></script>
@endsection
