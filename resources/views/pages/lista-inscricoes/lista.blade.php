@extends('layouts.app', ['activePage' => 'list_formulario_ativo', 'titlePage' => __('list_formulario_ativo')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            <main class="container">
                <div class="row">
                    <table id="lista-formulario">
                        <thead>
                        <tr>
                            <th>Formulário</th>
                            <th>Situação Edital</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listaFormularios as $lista)
                            <tr>
                                <td>{{$lista->nome_ou_anexo}}</td>
                                <td>
                                    @if(!is_null($lista->data_liberar) || $lista->status_liberar == 0)
                                        <p class="text-danger">Fechado</p>
                                    @else
                                        <p class="text-success">Aberto</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('escolaridade.lista.index', $lista->id)}}">
                                        <i class="fas fa-school mr-2"></i>
                                    </a>
                                    <a href="{{route('edital.formulario.anexo', $lista->editalDinamico->id)}}">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Formulário</th>
                            <th>Aberto</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/lista.js')}}"></script>
@endpush
