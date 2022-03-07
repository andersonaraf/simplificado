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
                        <div class="card-header">
                            <h4 class="card-title font-weight-bold">CRIAR GRUPO</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('grupo.update', $grupo->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col col-12 col-md-6 col-lg-6">
                                        <div class="form-group has-info">
                                            <label for="nomeFormulario" class="font-weight-bold">NOME GRUPO</label>
                                            <input type="text" class="form-control" name="nome"
                                                   id="nomeFormulario" placeholder="AUDITORES" value="{{$grupo->nome}}">
                                            @if($errors->has('nome'))
                                                <div class="alert alert-warning alert-dismissible fade show"
                                                     role="alert">
                                                    {{$errors->first('nome')}}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col col-12 text-md-right text-lg-right text-center">
                                        <div>
                                            <input type="submit" class="btn btn-outline-info font-weight-bold"
                                                   value="EDITAR GRUPO">
                                        </div>
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
    <script src="">
    </script>
@endpush
