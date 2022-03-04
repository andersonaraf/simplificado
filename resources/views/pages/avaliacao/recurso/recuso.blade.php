@if(isset($recurso))
    <div class="card" style="width: 100%">
        <div class="card-header bg-info">
            <h5 class="card-title text-white font-weight-bold">RECURSO</h5>
        </div>
        <div class="card-body">
            @if(!is_null($recurso->arquivo))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="anexo" class="text-dark font-weight-bold">ANEXO</h4>
                        <iframe
                            src="{{asset('storage/'.$recurso->arquivo)}}"
                            width="100%" height="620px">
                        </iframe>
                    </div>
                </div>
                <hr>
            @endif

            @if(!is_null($recurso->texto))
                <div class="has info">
                    <div class="col col-12">
                        <h4 for="texto" class="text-dark font-weight-bold">MOTIVO DA SOLICITAÇÃO DO RECURSO</h4>
                        <p>{{ mb_strtoupper($recurso->texto) }}</p>
                    </div>
                </div>
                <hr>
            @endif
        </div>
    </div>
@endif
