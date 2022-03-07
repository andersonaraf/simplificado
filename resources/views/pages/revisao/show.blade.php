@extends('layouts.app', [ 'activePage' => 'revisao', 'titlePage' => __('Lista de Candidatos')])
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
                                        @foreach($formulario->formularioUsuario as $formularioUsuario)
                                            @if(!is_null($formularioUsuario->avaliado) && (is_null($formularioUsuario->revisado)))
                                                <tr>
                                                    <td>{{mb_strtoupper($formularioUsuario->user->name)}}</td>
                                                    <td>{{ $formularioUsuario->user->pessoa->cpf}}</td>
                                                    <td>{{$formularioUsuario->cargo->cargo}}</td>
                                                    <td class="text-right">
                                                        @if(is_null($formularioUsuario->avaliado))
                                                            <span class="badge badge-pill badge-danger">NÃO AVALIADO</span>
                                                        @elseif($formularioUsuario->avaliado == 1)
                                                            <span class="badge badge-pill badge-success">AVALIADO</span>
                                                        @elseif($formularioUsuario->avaliado == 0)
                                                            <span class="badge badge-pill badge-danger">REPROVADO</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{route('revisao.candidato.dados', $formularioUsuario->id)}}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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
