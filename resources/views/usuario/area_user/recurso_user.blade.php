@extends('layouts.header-footer')
@section('recurso_user')
    <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="my-5">
                <div class="d-flex justify-content-end pb-4">
                    <a href="{{route('usuario.lista.processos', Auth::user()->id)}}">
                        <input type="button" class="btn btn-outline-primary" value="VOLTAR">
                    </a>
                </div>

                <form method="POST" action="{{route('usuario.recurso.salvar')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="formularioID" value="{{$formulario->id}}">
                    <div class="card card-header bg-primary">
                        <h5 class="text-white">Recurso</h5>
                    </div>
                    <div class="card card-body">
                        <div class="col col-12 has-info">
                            <label class="font-weight-bold" for="arquivo">Documento:</label>
                            <input type="file" name="arquivo" class="custom-file form-control-file">
                            @error('arquivo')
                            <br><span class="text-danger ">{{$message}}</span><br>
                            @enderror
                            <span class="text-warning font-weight-bold">O ARQUIVO DEVER ESTÁ EM FORMATO DE PDF.</span>
                        </div>

                        <div class="col col-12 has-info mt-3">
                            <b>Justificativa:</b>
                            <textarea required name="texto" class="form-control" rows="10" placeholder="Digite aqui ...." cols="100"
                                      maxlength="1000"></textarea>
                            <p id="tamanho">1000 <i>Caracteres</i></p>
                            @error('texto')
                            <br><span class="text-danger ">{{$message}}</span><br>
                            @enderror
                        </div>

                        <div class="col col-12 ">
                            <input type="submit" class="btn btn-outline-info text-center form-control font-weight-bold" value="ENVIAR">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            //NÃO DEIXA O TEXTAREA ACIMA DE 1000 CARACTERES
            $('textarea').keyup(function () {
                var texto = $(this).val();
                var tamanho = texto.length;
                if (tamanho > 1000) {
                    $(this).val(texto.substr(0, 1000));
                }
                //DIMINUIR O NUMERO DE CARACTERES
                $('#tamanho').html(1000 - tamanho + ' <i>Caracteres</i>');
            });
        });
    </script>
@endpush
