@extends('layouts.app', ['activePage' => 'TelaLiberar', 'titlePage' => __('TelaLiberar')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <input class="form-control" id="pesquisa" type="text" placeholder="Procurar..">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nome da Tela</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data Liberar</th>
                            <th scope="col">Opções</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @forelse($tipos_telas as $tela)
                            <tr>
                                <th>{{$tela->id}}</th>
                                <th>{{$tela->tipoTelas->tipo}}</th>
                                @if ($tela->tipoTelas->id == 2)
                                    <th>{{$tela->nome_anexo_mostrar}}</th>
                                @else
                                    <th>{{$tela->nome_ou_anexo}}</th>
                                @endif
                                <th>{{$tela->status_liberar}}</th>
                                @if (!is_null($tela->data_liberar))
                                    <th>{{$tela->data_liberar}}</th>
                                @elseif (is_null($tela->data_liberar) && $tela->status_liberar == '0')
                                    <th>Essa tela não está liberada</th>
                                @else
                                    <th>Essa tela está liberada</th>
                                @endif
                                <th>
                                    <a href="{{route('tela-unica-mostra', $tela->id)}}" style="margin-right: 15px"><i class="material-icons" style="color: blue">create</i></a>
                                    <a href="{{route('tela-deletar', $tela->id)}}"><i class="material-icons" style="color: red">delete</i></a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Nenhum Resultado Encontrado</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div style="width: 100%; margin-left: 50%">
                        {!! $tipos_telas->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
