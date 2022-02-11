@foreach($formularios as $item)
    <div class="col col-4 mt-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title font-weight-bold">{{$item->nome}}</h5>
            </div>
            <div class="card-body">
                <a href="{{route('usuario.formulario.show', $item->id)}}" class="btn btn-primary w-100">Acessar</a></a>
            </div>
        </div>
    </div>
@endforeach
