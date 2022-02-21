@extends('layouts.header-footer')
@section('recurso_user')
    <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="my-5">
                <div class="d-flex justify-content-end pb-4">
                    <a href="{{route('usuario.lista.processos', Auth::user()->id)}}"><button type="button" class="btn btn-outline-primary">Voltar</button></a>
                </div>

                <form method="POST" action="{{route('usuario.recurso.salvar')}}">
                    @csrf
                    <div class="card card-header bg-primary">
                   <h5 class="text-white">Recurso</h5>
                    </div>
                    <div class="card card-body">
                        <label class="font-weight-bold" for="arquivo">Documento:</label>
                        <input type="file" name="arquivo" class="form-control">
                        <b>Justificativa:</b>
                        <textarea required name="texto" rows="10" placeholder="Digite aqui ...." cols="100"></textarea>
{{--Adicionar um contador de caracteres--}}
                        <p>3200 de 4000 <i>Caracteres</i></p>
                        <button class="btn btn-outline-dark" type="submit">Enviar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
