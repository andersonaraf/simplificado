@foreach($formularios as $item)
    <div class="col col-4 mt-2">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title text-light font-weight-bold"><u>{{$item->nome}}</u></h5>
            </div>
            <div class="card-body">
                <a href="{{route('usuario.formulario.show', $item->id)}}" class="btn btn-outline-dark w-100">Acessar</a></a>
            </div>
        </div>
    </div>
@endforeach
