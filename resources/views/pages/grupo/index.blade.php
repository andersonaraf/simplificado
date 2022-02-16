@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Grupos', 'titlePage' => __('Grupos')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <main class="container" id="ajuste">
            <div class="row">
                <div class="col col-12 col-md-12 col-lg-12 text-md-right text-lg-right text-center">
                    <a href="{{route('formulario.create')}}"><input type="button"
                                                                    class="btn btn-outline-info font-weight-bold col-12 col-md-3 col-lg-2"
                                                                    value="NOVO GRUPO"></a>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white font-weight-bold">Lista de Grupos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <table id="dataTable" class="display table-hover nowrap" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>Grupos</th>
                                        <th>AÇÕES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @csrf
                                    @foreach($grupos as $grupo)
                                        <tr>
                                            <td>{{$formulario->nome}}</td>
                                            <td>
                                                <a href="#">
                                                    <span class="material-icons text-info">settings</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Grupos</th>
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
