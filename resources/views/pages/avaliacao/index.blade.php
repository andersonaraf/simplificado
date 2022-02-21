@extends('layouts.app', [ 'activePage' => 'avaliacao', 'titlePage' => __('Formulários')])
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
                                    <x-formulario>
                                        @csrf
                                        @foreach(auth()->user()->formularios() as $formulario)
                                            <tr>
                                                <td>{{$formulario->nome}}</td>
                                                <td>{{$formulario->formularioUsuario->count()}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('escolher.show', $formulario->id)}}"
                                                       title="LISTA DE PARTICIPANTES">
                                                        <span class="material-icons user text-info">settings</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </x-formulario>

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
