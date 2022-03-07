@if(isset($recurso))
    <div class="card" style="width: 100%">
        <div class="card-header bg-info">
            <h5 class="card-title text-white font-weight-bold">RECURSO</h5>
        </div>
        <div class="card-body has-info">
            @if(!is_null($recurso->arquivo))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="anexo" class="text-dark font-weight-bold">ANEXO</h4>
                        <iframe
                            src="{{asset('storage/'.$recurso->arquivo)}}"
                            width="100%" height="620px">
                        </iframe>
                        <hr>
                    </div>
                </div>
            @endif

            @if(!is_null($recurso->texto))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="texto" class="text-dark font-weight-bold">MOTIVO DA SOLICITAÇÃO DO RECURSO</h4>
                        <p>{{ mb_strtoupper($recurso->texto) }}</p>
                        <hr>
                    </div>
                </div>
            @endif
            <div class="col col-12">
                <label for="recursoPontuar" class="font-weight-bold text-dark">PONTUAR</label>
                <input type="number" class="form-control" name="recursoPontuacao" id="recursoPontuar" step="0.1" min="0"
                       max="{{$recurso->formularioUsuario->formulario->pontuacao - $formularioUsuario->pontuacao_total}}"
                       placeholder="0.0">
            </div>
        </div>
    </div>
@elseif(!is_null($formularioUsuario->recurso))
    <div class="card" style="width: 100%">
        <div class="card-header bg-info">
            <h5 class="card-title text-white font-weight-bold">RECURSO</h5>
        </div>
        <div class="card-body has-info">
            @if(!is_null($formularioUsuario->recurso->arquivo))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="anexo" class="text-dark font-weight-bold">ANEXO</h4>
                        <iframe
                            src="{{asset('storage/'.$formularioUsuario->recurso->arquivo)}}"
                            width="100%" height="620px">
                        </iframe>
                        <hr>
                    </div>
                </div>
            @endif

            @if(!is_null($formularioUsuario->recurso->texto))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="texto" class="text-dark font-weight-bold">MOTIVO DA SOLICITAÇÃO DO RECURSO</h4>
                        <p>{{ mb_strtoupper($formularioUsuario->recurso->texto) }}</p>
                        <hr>
                    </div>
                </div>
            @endif
            <div class="col col-12">
                <label for="recursoPontuar" class="font-weight-bold text-dark">PONTUAÇÃO APLICADA</label>
                <input type="number" class="form-control" value="{{$formularioUsuario->recurso->pontuacao}}" disabled>
            </div>
        </div>
    </div>
@endif
