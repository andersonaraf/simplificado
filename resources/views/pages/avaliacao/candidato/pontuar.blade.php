@if($pontuavel && $campo->pontuar == 1 && !is_null($formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()))
    <div class="col col-12 has-info mt-4">
        <label class="font-weight-bold text-dark" for="{{$campo->nome}}">PONTUAR CAMPO</label>
        <input type="number" class="form-control"
               data-usuario-campo="{{$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}"
               data-required="{{$campo->atributos->required}}"
               id="{{$campo->nome}}"
               placeholder="0.0" step="0.1"
               max="{{!is_null($campo->ponto) ? $campo->ponto : 100}}" min="0">
        {{--        SPAN ERROR--}}
        <span class="invalid-feedback" role="alert" id="span-{{$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}">
            <strong id="error-{{$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}"></strong>
        </span>
    </div>
@endif
