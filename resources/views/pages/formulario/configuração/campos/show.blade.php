@extends('layouts.app', [ 'activePage' => 'user-management', 'subActivePage' => 'Formulários', 'titlePage' => __('Configuração do Formulário')])
@push('css')
    <style>
        ::placeholder {
            color: black !important;
            opacity: 0.5 !important;
        }
        .bg-hover:hover{
            color: #ffffff !important;
            background-color: #006eff !important;
        }

        span {
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row justify-content-end">
                    <a href="{{route('configuracao.create', $cargo->escolaridade->formulario->id)}}"
                       class="font-weight-bold text-info"><span class="material-icons">arrow_back</span>VOLTAR</a>
                    <b class="text-info ml-2"> | </b>
                    <a href="{{route('formulario.index')}}" class="font-weight-bold text-info ml-2">FORMULÁRIOS</a>
                </div>
                <hr>
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-8">
                                    @if(session('status'))
                                        <span class="alert form-control alert-success font-weight-bold" role="alert">{{session('status')}}</span>
                                        {{session()->forget('status')}}
                                    @endif
                                    @error('error')
                                        <span class="alert form-control alert-success font-weight-bold">{{session('error')}}</span>
                                        {{session()->forget('error')}}
                                     @enderror
                                    <h4 class="card-title font-weight-bold">
                                        CONFIGURAÇÃO: {{$cargo->escolaridade->formulario->nome}}</h4>
                                    <b class="card-subtitle">{{$cargo->cargo}}</b>
                                </div>
                                <div class="col col-4 text-right">
                                    <a href="#">
                                        <span class="material-icons text-info">visibility</span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="col col-12 co-lg-12 col-md-12 text-right">
                                <input type="button" class="btn bg-hover btn-outline-info font-weight-bold" data-toggle="modal"
                                       data-target="#novoCollapse" value="NOVO CABEÇALHO">
                            </div>
                            <div class="row">
                                <div class="col col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="accordion" id="accordionExample">
                                            @forelse($cargo->collapse as $key=>$collapse)
                                                <div class="card">
                                                    <div class="card-header card-header-info">
                                                        <div class="row">
                                                            <div class="col col-6">
                                                                <div class="row">
                                                                    <div class="col col-12">
                                                                        <div class="input-group has-warning">
                                                                            <input type="text"
                                                                                   class="font-weight-bold text-white form-control collapse-send"
                                                                                   data-collapse-id="{{$collapse->id}}"
                                                                                   data-form="{{route('collapse.update', $collapse->id)}}"
                                                                                   name="collapseName"
                                                                                   value="{{$collapse->nome}}">
                                                                            <div class="input-group-prepend">
                                                                                <button
                                                                                    class=" input-group-text material-icons text-white">
                                                                                <span>
                                                                                    edit
                                                                                </span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col col-6 text-right" id="heading{{$key}}"
                                                                 data-toggle="collapse"
                                                                 href="#collapse{{$key}}" aria-expanded="true"
                                                                 aria-controls="collapse{{$key}}"
                                                                 style="cursor:pointer;">
                                                                <a href="javascript:void(0);" class="delete_item_sweet"
                                                                   data-action="{{route('collapse.destroy', $collapse->id)}}">
                                                                    <span
                                                                        class="material-icons text-danger">delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapse{{$key}}" class="collapse show"
                                                         aria-labelledby="heading{{$key}}"
                                                         data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            @forelse($collapse->campos as $campo)

                                                            @empty
                                                                @include('pages.formulario.configuração.campos.create', ['$collapse_id' => $collapse->id])
                                                            @endforelse
                                                            <h1>Listar formulario</h1>
                                                            <p>exemplo</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <h5 class="font-weight-bold">ESSE FORMULÁRIO NÃO POSSUI
                                                            CAMPOS</h5>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('pages.formulario.configuração.collapse.create')
@endsection
@push('js')
    <script>
        @error('nomeCollapse')
        $('#novoCollapse').modal().show()
        @enderror

        $('.collapse-send').change(function () {
            $.ajax({
                url: $(this).attr('data-form'),
                method: 'PUT',
                data: {
                    "token": "{{csrf_token()}}",
                    "id": $(this).attr('data-collapse-id'),
                    "nomeCollapse": $(this).val(),
                },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'AVISO',
                        text: 'Alterado com sucesso.',
                        timer: 1000,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    })
                },
                error: function (data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'AVISO',
                        text: 'Ocorreu um error.',

                    })
                }
            });
        })

        function label(campo) {
            $('#input' + campo).keyup(function () {
                $('#label' + campo).text($(this).val());
            });
        }

        function place(campo) {
            $('#placeholder' + campo).keyup(function () {
                $('#inputresult'+campo).attr('placeholder',$(this).val());
            });
        }

        function select(select) {
            let val = $('#select' + select).val()
            if (val == 1) {
                let input = "<input type='text' id='inputresult"+select+"' class='form-control' disabled/>"
                $('#resultadoinput' + select).empty()
                $('#resultadoinput' + select).append(input)
            } else if (val == 2) {
                let input = "<input type='file' class='form-control' disabled/>"
                $('#resultadoinput' + select).empty()
                $('#resultadoinput' + select).append(input)
            } else if (val == 3) {
                let input = "<select class='form-control'><option>Exmplo 1</option><option>Exmplo 2</option></select>"
                $('#resultadoinput' + select).empty()
                $('#resultadoinput' + select).append(input)
            } else if (val == 4) {
                let input = "<input type='date' class='form-control'disabled/>Exemplo Campo Data"
                $('#resultadoinput' + select).empty()
                $('#resultadoinput' + select).append(input)
            }

        }


    </script>
@endpush
