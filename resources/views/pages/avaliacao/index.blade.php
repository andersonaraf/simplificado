@extends('layouts.app', [ 'activePage' => 'avaliacao', 'avaliacao' => 'Formulários', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white font-weight-bold">LISTA DE FORMULÁRIOS</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>FORMULÁRIO</th>
                                            <th>CANDIDATOS</th>
                                            <th class="text-right">OPÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @csrf
                                        @foreach($formularios as $formulario)
                                            <tr>
                                               <td>{{$formulario->nome}}</td>
                                               <td>{{$formulario->formularioUsuario->count()}}</td>
                                               <td class="text-right">
                                                   <a href="{{route('formulario.show', $formulario->id)}}" title="LISTA DE PARTICIPANTES">
                                                       <span class="material-icons user text-info">settings</span>
                                                   </a>
                                               </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>FORMULÁRIO</th>
                                            <th>CANDIDATOS</th>
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
