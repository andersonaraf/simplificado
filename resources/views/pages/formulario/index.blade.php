@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Formulários')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <div class="col col-12 col-md-12 col-lg-12 text-md-right text-lg-right text-center">
                        <a href="{{route('formulario.create')}}"><input type="button" class="btn btn-outline-info font-weight-bold col-12 col-md-3 col-lg-2" value="NOVO FORMULÁRIO"></a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">Lista de Formulários</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 col-md-12">
                                    <table id="dataTable" class="display nowrap" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>FORMULÁRIO</th>
                                            <th>STATUS</th>
                                            <th>DATA LIBERADO</th>
                                            <th>DATA FINALIZADO</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($formularios as $formulario)
                                            <tr>
                                                <td>{{$formulario->nome}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>FORMULÁRIO</th>
                                            <th>STATUS</th>
                                            <th>DATA LIBERADO</th>
                                            <th>DATA FINALIZADO</th>
                                            <th>AÇÕES</th>
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
