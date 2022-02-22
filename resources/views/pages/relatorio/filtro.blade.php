@extends('layouts.app', [ 'activePage' => 'formularios-relatorios', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">FILTRO DO FORMULÁRIO: {{$formulario->nome}}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-12 col-md-12 has-info">
                                        <label class="text-dark font-weight-bold">CARGO:</label>
                                        <select class="custom-select">
                                            <option class="" required>NÃO SELECIONADO</option>
                                            @foreach($formulario->escolaridades as $escolaridade)
                                                @foreach($escolaridade->cargos as $cargo)
                                                    <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col col-12 col-lg-6 col-md-6 has-info mt-3">
                                        <label class="text-dark font-weight-bold">TIPO DE APROVAÇÃO:</label>
                                        <select class="custom-select">
                                            <option class="" required>TODOS</option>
                                            <option value="1">APROVADO</option>
                                            <option value="0">REPROVADO</option>
                                        </select>
                                    </div>

                                    <div class="col col-12 col-lg-6 col-md-6 has-info mt-3">
                                        <label class="text-dark font-weight-bold">PNE:</label>
                                        <select class="custom-select">
                                            <option class="" required>TODOS</option>
                                            <option value="1">COM PNE</option>
                                            <option value="0">SEM PNE</option>
                                        </select>
                                    </div>

                                    <div class="col col-12 col-lg-12 col-md-12 has-info mt-3">
                                        <label class="text-dark font-weight-bold">NOME:</label>
                                        <input type="text" class="form-control" placeholder="NOME DO PARTICIPANTE">
                                    </div>

                                    <div class="col col-12 col-lg-6 col-md-6 has-info mt-3">
                                        <p class="font-weight-bold text-danger">OBSERVAÇÃO: TODOS OS RELATÓRIOS SÃO
                                            GERADOS EM PDF E
                                            ORDENANDOS POR PONTUAÇÃO, UTILIZANDO A DATA DE NASCIMENTO COMO CRITÉRIO DE
                                            DESEMPATE.</p>
                                    </div>

                                    <div class="col col-12 col-lg-12 col-md-12 text-right has-info mt-3">
                                        <input type="submit" class="btn btn-outline-info" value="GERAR RELATÓRIO">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
@endpush
