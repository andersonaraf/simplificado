@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Lista de Candidatos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">LISTA DE CANDIDATOS</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>NOME CANDIDATO</th>
                                            <th>CPF</th>
                                            <th>CARGO</th>
                                            <th class="text-right">STATUS</th>
                                            <th class="text-right">OPÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @csrf
                                        @foreach(isset($avaliador[0]) ? $avaliador : $formulario->formularioUsuario as $formularioUsuario)
                                            <tr>
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->user->name : mb_strtoupper($formularioUsuario->user->name)}}</td>
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->user->pessoa->cpf : $formularioUsuario->user->pessoa->cpf}}</td>
                                                <td>{{isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->cargo->cargo : $formularioUsuario->cargo->cargo}}</td>
                                                <td class="text-right"></td>
                                                <td class="text-right">
                                                    <a href="{{route('candidato.show',isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->id : $formularioUsuario->id)}}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                    <a href="{{route('candidato.edit',isset($avaliador[0]) ? $formularioUsuario->formularioUsuario->id : $formularioUsuario->id)}}"
                                                       class="btn btn-sm btn-primary" title="REALIZAR PONTUAÇÃO">
                                                        <i class="material-icons">123</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>NOME CANDIDATO</th>
                                            <th>CPF</th>
                                            <th>CARGO</th>
                                            <th class="text-right">STATUS</th>
                                            <th class="text-right">OPÇÕES</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/dashboard/tabela.js')}}" defer></script>
@endpush
