@extends('layouts.header-footer')
@section('view_user')
    <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="my-5">
                <div class="d-flex justify-content-end pb-4">
                    <a href="{{route('usuario.lista.processos', Auth::user()->id)}}">
                        <button type="button" class="btn btn-outline-primary">Voltar</button>
                    </a>
                </div>
                <div class="col-12 card card-header bg-primary ">
                    <div class="d-flex justify-content-center">
                        <img style="width:20em;" src="{{asset('images/brancapref.png')}}">
                    </div>
                </div>

                <div class="card card-body">
                    @foreach($formularioUsuario as $formuser)
                        <div class="row">
                            {{--COLUNA ESQUERDA--}}
                            <div class="col-6">
                                <label>Nome Candidato:</label>
                                <input class="form-control" type="text" value="{{strtoupper($formuser->user->name)}}" disabled>
                                <br>
                                <label>Data Nascimento:</label>
                                <input class="form-control" type="text"
                                       value="{{date('d/m/Y',strtotime($formuser->user->pessoa->data_nascimento))}}"
                                       disabled>
                                <br>
                            </div>
                            {{--COLUNA DIREITA--}}
                            <div class="col-6">
                                <label>CPF Candidato:</label>
                                <input class="form-control" type="text" value="{{$formuser->user->pessoa->cpf}}"
                                       disabled>
                                <br>
                                @if($formuser->user->pessoa->portador_deficiencia == 0)
                                    <label>PNE:</label>
                                    <input class="form-control" type="text" value="{{strtoupper('nÃo')}}" disabled>
                                @else
                                    <label>PNE:</label>
                                    <input class="form-control" type="text" value="{{strtoupper('sim')}}" disabled>
                                @endif
                                <br>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 card card-header bg-primary ">
                    <div class="d-flex justify-content-center">
                        <h5 class="text-white">Cargo</h5>
                    </div>
                </div>
                {{--CARGO PARTICIPANTE--}}
                <div class="card card-body">
                    @foreach($formularioUsuario as $formuser)
                        <div class="row">
                            {{--COLUNA ESQUERDA--}}
                            <div class="col-6">
                                <label>Nome Formulário:</label>
                                <input class="form-control" type="text" value="{{strtoupper($formuser->formulario->nome)}}"
                                       disabled>
                                <br>
                                <label>Maximo Pontuação Possivel:</label>
                                <input class="form-control" type="text"
                                       value="{{$formuser->formulario->pontuacao}} pontos"
                                       disabled>
                                <br>
                            </div>
                            {{--COLUNA DIREITA--}}
                            <div class="col-6">
                                <label>Cargo:</label>
                                <input class="form-control" type="text" value="{{strtoupper($formuser->cargo->cargo)}}" disabled>
                                <br>
                                <label>Escolaridade:</label>
                                <input class="form-control" type="text" value="{{$formuser->cargo->escolaridade->nivel_escolaridade}}" disabled>

                                <br>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 card card-header bg-primary ">
                    <div class="d-flex justify-content-center">
                        <h5 class="text-white">ANEXOS</h5>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
