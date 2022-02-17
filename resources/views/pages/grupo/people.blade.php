@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Grupos', 'titlePage' => __('Grupos')])
@push('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush
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
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">PESSOAS</h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <input type="hidden" value="{{$id}}" id="grupo_id">
                                <div class="row">
                                    <div class="col col-12 col-md-12 col-lg-12">
                                        <div class="form-group has-info">
                                            <label for="nomePessoa" class="font-weight-bold">NOME DA PESSOA</label>
                                            <input type="text" class="form-control" name="nome"
                                                   id="nomePessoa" placeholder="JOAO">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col col-12 p-0">
                                        <hr>
                                        <h6>Lista De Servidores</h6>
                                        <hr>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="font-weight-bold">Nome</th>
                                                <th scope="col" class="font-weight-bold">Ação</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @foreach($grupoUsers as $grupo)
                                                <tr id="">
                                                    <td scope="row">{{$grupo->user->name}}</td>
                                                    <td>
                                                        <button class="btn btn-danger remove"
                                                                data-list-id="{{$grupo->id}}" id="remove{{$grupo->id}}"
                                                                type="button">Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/dashboard/tabela.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            let peoples = [];
            $('#nomePessoa').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: '{{route('grupo.search')}}',
                        dataType: 'json',
                        method: 'post',
                        data: {
                            term: request.term,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            var data2 = data.map(function (datamin) {
                                return {
                                    value: datamin.name,
                                    id: datamin.id,
                                }
                            })
                            response(data2)
                        },
                    });
                },
                minLength: 3,
                select: function (event, ui) {
                    if (peoples.find(x => x.id === ui.item.id)) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'SERVIDOR JÁ ESTÁ NA LISTA.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload()
                        })
                        return false;
                    }
                    peoples.push(ui.item);
                    $('#tbody').append(`<tr id="${ui.item.id}">
                        <td scope="row">${ui.item.value}</td>
                        <td>
                            <button class="btn btn-danger remove" id="${ui.item.id}" type="button">Remove</button>
                        </td>
                    </tr>`);

                    $.ajax({
                        url: '{{route('grupo.adicionarpeople')}}',
                        method: 'post',
                        data: {
                            peoples: peoples,
                            grupo_id: $('#grupo_id').val(),
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'LISTA SALVA COM SUCESSO.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            peoples = [];
                        },
                        error: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'ERRO AO SALVAR LISTA.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });

                    return false;
                }
            });


            $('#tbody').on('click', '.remove', function () {
                // Getting all the rows next to the row
                // containing the clicked button
                var child = $(this).closest('tr').nextAll();
                // Removing the current row.
                $(this).closest('tr').remove();
                peoples.splice(peoples.findIndex(x => x.id === $(this).attr('id')), 1);

            });

            $('.remove').click(function () {
                $.ajax({
                    url: '{{route('grupo.removepeople')}}',
                    method: 'POST',
                    data: {
                        grupoUser_id: $(this).attr('data-list-id'),
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'SERVIDOR REMOVIDO COM SUCESSO.',
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
                            title: 'ERRO AO REMOVER',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });

                return false;


        })


        })


    </script>
@endpush
