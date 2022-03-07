@extends('layouts.header-footer')
<style>
    .hover-div:hover {
        background-color: #007bff;
        color: white;
    }
</style>
@section('content')
    <div class="container">
        <div class="col-12 card card-header bg-primary ">
            <div class="d-flex justify-content-center">
                <img style="width:20em;" src="{{asset('images/brancapref.png')}}">
            </div>
        </div>
        <div class="row">
            <div id="accordion" class="mt-3 col-12">
                @foreach ($formulario->escolaridades as $escolaridade)
                    @if($escolaridade->bloquear == 0)
                        <div class="card" data-toggle="collapse" data-target="#collapse{{$escolaridade->id}}">
                            <div class="card-header bg-primary" id="headingOne">
                                <h5 class="mb-0 text-white">
                                    {{$escolaridade->nivel_escolaridade}}
                                    {{--aria-expanded="true" aria-controls="collapseOne"--}}
                                </h5>
                            </div>
                            <div id="collapse{{$escolaridade->id}}" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card card-body">
                                    <div class="col-12 ">
                                        <ul class="list-group list-group-flush ">
                                            @foreach($escolaridade->cargos as $cargo)
                                                @if($cargo->bloquear == 0)
                                                    <a href="{{route('usuario.formulario.create',['cargo_id'=> $cargo->id, 'formulario_id'=>$formulario->id])}}">
                                                        <li class="list-group-item hover-div">{{$cargo->cargo}}</li>
                                                    </a>
                                                    <br>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
