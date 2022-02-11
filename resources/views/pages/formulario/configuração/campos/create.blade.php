<div class="row">
    <div class="col col-10">
        <div class="form-group has-info">
            <input type="text" class="form-control campoNome" placeholder="Titulo do campo" id="input{{$collapse->id}}"                                                                                    id="{{$collapse->id}}"
            onkeyup="label({{$collapse->id}})"/>
        </div>
        <div id="collapseCampo{{$key}}" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col col-12">
                        <div class="form-group has-info">
                            <div class="row">
                                <div class="col col-6">
                                    <label for="exampleFormControlFile1" class="font-weight-bold text-dark"
                                           id="label{{$collapse->id}}"></label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" disabled>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">Pontuar: </label>
                                        <input type="number" class='form-control pontuarCampo' placeholder="PONTUAÇÃO DO CAMPO / VAZIO PARA NÃO PONTUAR" step="0.1" min="0" max="{{$cargo->escolaridade->formulario->pontuacao}}">
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col col-12">
                                        <a href="#">Salvar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-2 text-right">
        <a href="#collapseCampo{{$key}}" data-toggle="collapse" aria-expanded="true"
           aria-controls="collapseCampo{{$key}}">
            <span class="material-icons text-info" title="Personalizar">code</span>
        </a>
        <a href="javascript:void(0);" class="delete_item_sweet"
           data-action="#">
            <span class="material-icons text-danger">delete</span>
        </a>
    </div>
</div>
<hr>
