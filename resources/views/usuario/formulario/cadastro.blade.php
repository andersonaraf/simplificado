@extends('layouts.header-footer')

@section('content')
    <div class="container">
        <h4 class="mt-5">Formulário de Inscrição</h4>
        <form action="{{route('usuario.formulario.store')}}" id="formData" method="post" enctype="multipart/form-data">
            {{--            <input type="hidden" name='formulario' value="{{$formulario_id}}">--}}
            {{--            <input type="hidden" name='cargo' value="{{$cargo_id}}">--}}
            <div id="accordion">
                <div class="card">
                    @foreach($collapses as $collaps)
                        <div class="card-header" id="heading{{$collaps->id}}">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                        data-target="#collapse{{$collaps->id}}" aria-expanded="true"
                                        aria-controls="collapse{{$collaps->id}}">
                                    {{$collaps->nome}}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$collaps->id}}" class="collapse show" aria-labelledby="heading{{$collaps->id}}"
                             data-parent="#accordion">
                            <div class="card-body">
                                @foreach($collaps->campos as $campo)
                                    @include('usuario.formulario.tipoCampo')
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-primary btn-lg mt-2" id="enviarForm">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            //OBJETO DO CAMPO
            let campo = {
                id: null,
                value: null,
                setId: function (id) {
                    this.id = id;
                },
                setValue: function (value) {
                    this.value = value;
                },
            }

            $('#enviarForm').click(function () {
                let campos = [];
                let camposObrigatoriosOk = true;
                let ajaxData = new FormData();
                $('#formData').find('input').each(function () {
                    if ($(this).attr('required')) {
                        if ($(this).val() === '') {
                            camposObrigatoriosOk = false;
                            $(this).addClass('is-invalid');
                            return false;
                        } else {
                            $(this).removeClass('is-invalid');

                            //VERIFICAR SE É UM ARQUIVO
                            if ($(this).attr('type') === 'file') {
                                ajaxData.append($(this).data('id'), $(this)[0].files[0]);
                            }
                            else {
                                ajaxData.append($(this).data('id'), $(this).val());
                            }
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        if ($(this).attr('type') === 'file') {
                            ajaxData.append($(this).data('id'), $(this)[0].files[0]);
                        }
                        else {
                            ajaxData.append($(this).data('id'), $(this).val());
                        }
                    }
                });
                //ENVIAR OS DADOS
                if (true) {
                    // INFORMAÇÕES NECESSÁRIAS
                    ajaxData.append('formulario', '{{$formulario_id}}');
                    ajaxData.append('cargo', '{{$cargo_id}}');
                    $.ajax({
                        url: '{{route('usuario.formulario.store')}}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        data: ajaxData,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function (data) {
                            if (data.status) {
                                Swal.fire({
                                    title: 'Sucesso!',
                                    text: 'Formulário cadastrado com sucesso!',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(function () {
                                    window.location.href = '{{route('inicio')}}';
                                });
                            } else {
                                Swal.fire({
                                    title: 'Erro!',
                                    text: 'Erro ao cadastrar formulário!',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        },
                        error: function (data) {
                            data = JSON.parse(data.responseText);
                            console.log(data)
                            Swal.fire({
                                title: 'Erro!',
                                text: data.error,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
