@if($pontuavel && $campo->pontuar == 1)
    <div class="col col-12 has-info mt-4">
        <label class="font-weight-bold text-dark" for="{{$campo->nome}}">PONTUAR CAMPO</label>
        <input type="number" class="form-control"
               data-usuario-campo="{{$formularioUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}"
               data-required="{{$campo->atributos->required}}"
               id="{{$campo->nome}}"
               placeholder="0.0" step="0.1"
               max="{{!is_null($campo->ponto) ? $campo->ponto : 100}}" min="0"  disabled value="{{$campo->ponto}}">
        {{--        SPAN ERROR--}}
        <span class="invalid-feedback" role="alert" id="span-{{$formularioUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}">
            <strong id="error-{{$formularioUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}"></strong>
        </span>
    </div>
@endif
