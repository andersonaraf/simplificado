@if($pontuavel && $campo->pontuar == 1)
    <div class="col col-12 has-info mt-4">
        <h5 class="font-weight-bold text-dark">PONTUAR CAMPO</h5>
        <input type="number" class="form-control"
               data-usuario-campo="{{$formulariUsuario->formularioUsuarioCampo->where('campo_id', $campo->id)->first()->id}}"
               placeholder="0.0" step="0.1"
               max="{{!is_null($campo->ponto) ? $campo->ponto : 100}}" min="0">
    </div>
@endif
