<div class="row">
    @foreach($recursos as $item)
        @if(auth()->check())
            @if(!is_null($item->buscarFormularioUsuario(auth()->user()->id)))
                <div class="col col-4 mt-2">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="card-title text-light font-weight-bold"><u>{{$item->nome}}</u></h5>
                        </div>
                        <div class="card-body">
                            <a href="{{auth()->check() ?  route('usuario.recurso', $item->buscarFormularioUsuario(auth()->user()->id)->id): route('register')}}"
                               class="btn btn-outline-dark w-100">Solicitar</a></a>
                        </div>
                    </div>
                </div>
            @endif
            @if($loop->last)
{{--                MOSTRAR MAIS--}}
               <div class="col col-12 mt-2 pb-2">
                    <a href="{{route('usuario.lista.processos', auth()->id())}}" class="font-weight-bold">MOSTRAR MAIS</a>
               </div>
            @endif
        @endif
    @endforeach
</div>
