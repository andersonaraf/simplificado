<form method="POST" action="{{route('formulario.store')}}">
    @csrf
<div class="row">
    <div class="col col-10">
        <div class="row form-group has-info d-flex justify-content-around">
            <div class="col-6">
                <label class="font-weight-bold bmd-label-static">Título do campo</label>
                <input name="titulo_campo" type="text" class="form-control campoNome" id="input{{$collapse->id}}" id="{{$collapse->id}}"
                       onkeyup="label({{$collapse->id}})"/>

            </div>
            <div class="col col-6">
                <label for="exampleFormControlFile1" class="font-weight-bold bmd-label-static"
                       id="label{{$collapse->id}}"></label>
                <div id="resultadoinput{{$collapse->id}}">
                </div>
            </div>
            <div class="col-4">
                <label for="checkbox" class="">Campo Obrigatório</label>
                <input name="required_campo"  type="checkbox">
            </div>
        </div>
        <div id="collapseCampo{{$key}}" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col col-12">
                        <div class="form-group has-info">
                            <div class="row">
                                <div class="col col-6">
                                    <select name="tipo_campo" class="form-control" id="select{{$collapse->id}}"
                                            onclick="select({{$collapse->id}})">
                                        <option value="">----</option>
                                        @foreach($tipo_campo as $campo)
                                            <option value="{{$campo->id}}">{{$campo->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">Pontuar: </label>
                                        <input name="pontuacao" type="number" id="pontuarCampo{{$collapse->id}}"
                                               class='form-control pontuarCampo'
                                               placeholder="PONTUAÇÃO DO CAMPO / VAZIO PARA NÃO PONTUAR" step="0.1"
                                               min="0" max="{{$cargo->escolaridade->formulario->pontuacao}}">
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col col-12 py-4">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
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
</form>
