@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Grupos', 'titlePage' => __('Grupos')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end">
                    <a href="{{route('grupo.index')}}" class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                </div>
                <hr>
                <div class="row">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title font-weight-bold text-white">PARTICIPANTES</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                @csrf
                                <input type="hidden" value="{{$user_id}}" id="avaliador_id" name="avaliador_id">

                                <div class="row">
                                    <div class="col col-12 p-0">
                                        <hr>
                                        <h6 class="ml-2">LISTA DE PARTICIPANTES</h6>
                                        <hr>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="font-weight-bold">Nome</th>
                                                <th scope="col" class="font-weight-bold">Ação</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($candidatos as $candidato)
                                                <tr id="">
                                                    <td scope="row">{{$candidato->user->name}}</td>
                                                    <td>
                                                        <button class="btn btn-info avaliar"
                                                                data-participante-id="{{$candidato->id}}">
                                                            AVALIAR
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
    <script>
        $('.avaliar').click(function (){
            $.ajax({
                url: '{{route('avaliador.store')}}',
                method: 'post',
                data: {
                    avaliador: $('#avaliador_id').val(),
                    formulario_usuario: $(this).attr('data-participante-id'),
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload()
                    })
                },
                error: function (data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        })

    </script>
@endpush
