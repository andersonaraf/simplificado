@extends('layouts.header-footer')

@section('content')
    <div class="container">
        <div class="row">
            <div id="accordion" class="mt-5 col-12">
                @foreach ($formulario->escolaridades as $escolaridade)
                    @if($escolaridade->bloquear == 0)
                        <div class="card" data-toggle="collapse" data-target="#collapse{{$escolaridade->id}}">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" aria-expanded="true" aria-controls="collapseOne">
                                        {{$escolaridade->nivel_escolaridade}}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse{{$escolaridade->id}}" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="card col-12">
                                        <ul class="list-group list-group-flush">
                                            @foreach($escolaridade->cargos as $cargo)
                                                @if($cargo->bloquear == 0)
                                                    <a href="{{route('usuario.formulario.create',['cargo_id'=> $cargo->id, 'formulario_id'=>$formulario->id])}}">
                                                        <li class="list-group-item">{{$cargo->cargo}}</li>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
@endsection
