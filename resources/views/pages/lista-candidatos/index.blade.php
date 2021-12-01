@extends('layouts.app', ['activePage' => 'lista_participantes', 'titlePage' => __('Lista Candidatos')])
@extends('layouts.modal-message')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col col-12">
                <div class="card" id="dataTables-lista" style="width: 100%; padding: 20px">
                    <table id="data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pessoas as $pessoa)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/lista-candidatos/lista.js')}}"></script>
@endsection
