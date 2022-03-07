@foreach($formulariUsuario->cargo->collapse as $collapse)
    <div class="card" style="width: 100%">
        <div class="card-header bg-info">
            <h5 class="card-title text-white font-weight-bold">{{mb_strtoupper($collapse->nome)}}</h5>
        </div>
        <div class="card-body">
            @foreach($collapse->campos as $campo)
                @if(mb_strtoupper($campo->tipoCampo->tipo) == 'ARQUIVO')
                    <div class="has info">
                        <div class="col col-12">
                            <h4 for="{{$campo->nome}}" class="text-dark font-weight-bold">{{$campo->nome}}</h4>
                            <iframe
                                src="{{asset('storage/'.$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->valor)}}"
                                width="100%" height="620px">
                            </iframe>
                        </div>
                    </div>
                @else
                    {{--CAMPO NORMAL--}}

                    <div class="has info">
                        <div class="col col-12 has-info">
                            <h4 for="{{$campo->nome}}" class="text-dark font-weight-bold">NOME DO CAMPO: {{$campo->nome}}</h4>
                            <input type="text" class="form-control" id="{{$campo->nome}}"
                                   value="{{$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first() != null ? $formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->valor : ''}}"
                                   disabled>
                        </div>
                    </div>
                @endif
                @include('pages.avaliacao.candidato.pontuar')
                <hr>
            @endforeach
            <hr>
        </div>
    </div>
@endforeach
