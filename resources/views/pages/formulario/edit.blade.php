<div class="row">
    <div class="col col-12 col-md-6 col-lg-6">
        <div class="form-group has-info">
            <label for="nomeFormulario" class="font-weight-bold">NOME FORMULÁRIO</label>
            <input type="text" class="form-control" name="nomeFormulario" id="nomeFormulario" placeholder="RB SIMPLIFICADO {{date('Y')}}" value="{{$formulario->nome  }}">
        </div>
    </div>

    <div class="col col-12 col-md-6 col-lg-6">
        <div class="form-group has-info">
            <label for="pontuacaoTotal" class="font-weight-bold">PONTUAÇÃO TOTAL: </label>
            <input type="number" class="form-control" name="pontuacaoTotal" id="pontuacaoTotal" min="0" max="100" value="{{$formulario->pontuacao}}"
                   placeholder="PONTUAÇÃO MÁXIMA DO FORMULÁRIO">
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col col-12">
        <div class="form-group has-info">
            <label for="dataInicio" class="font-weight-bold">LIBERAR FORMULÁRIO: {{date('d/m/Y H:i', strtotime($formulario->data_liberar))}}</label>
            <input type="datetime-local" class="form-control" name="dataInicio" id="dataInicio" value="{{str_replace(' ','T', $formulario->data_liberar)}}">
        </div>
    </div>

    <div class="col col-12">
        <div class="form-group has-info">
            <label for="dataFinalizar" class="font-weight-bold">FINALIZAR FORMULÁRIO: {{date('d/m/Y H:i', strtotime($formulario->data_fecha))}}</label>
            <input type="datetime-local" class="form-control" name="dataFinalizar" id="dataFinalizar" value="{{str_replace(' ','T', $formulario->data_fecha)}}">
        </div>
    </div>
</div>
