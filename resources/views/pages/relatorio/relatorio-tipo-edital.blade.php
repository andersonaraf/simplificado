@extends('layouts.app', ['activePage' => 'relatorio', 'titlePage' => __('Relatorio')])
@extends('layouts.modal-message')
@section('css')
    <style>
        a .card:hover {
            box-shadow: 10px 5px 5px black;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h3>Selecionar um Edital</h3>
            </div>
            @foreach($editalDinamicos as $editalDinamico)
                <div class="row justify-content-center">
                    <a href="{{route('relatorio.visualizar', $editalDinamico->id)}}" style="width: 100%">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 class="font-weight-bold">{{$editalDinamico->tipoTela->nome_ou_anexo}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>


@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
