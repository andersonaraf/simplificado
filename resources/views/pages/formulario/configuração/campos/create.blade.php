<form method="POST" action="{{route('formulario.store')}}">
    @csrf
    <input name="collapse_id" value="{{$collapse->id}}" hidden>
    <div class="row">
        <div class="col col-10">
            <div class="row has-info d-flex justify-content-around">
                <div class="col-6">
                    <label class="font-weight-bold bmd-label-static">Título do campo</label>
                    <input required name="titulo_campo" type="text" class="form-control campoNome"
                           id="input{{$collapse->id}}" id="{{$collapse->id}}"
                           onkeyup="label({{$collapse->id}})"/>
                </div>

                <div class="col col-6">
                    <label for="exampleFormControlFile1" class="font-weight-bold bmd-label-static"
                           id="label{{$collapse->id}}"></label>
                    <div id="resultadoinput{{$collapse->id}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col col-2 text-right">
            <a href="#collapseCampo{{$key}}" data-toggle="collapse" aria-expanded="true"
               aria-controls="collapseCampo{{$key}}">
                <span class="material-icons text-info" title="Personalizar">code</span>
            </a>
        </div>

        <div id="collapseCampo{{$key}}" class="collapse show w-100">
            <div class="col col-12">
                <div class="has-info">
                    <div class="row">

                        <div class="col col-12 col-md-3 col-lg-3">
                            <label class="font-weight-bold text-dark">Selecione o Tipo do Campo:</label>
                            <select name="tipo_campo" class="form-control" id="select{{$collapse->id}}"
                                    onclick="select({{$collapse->id}})" required>
                                @foreach($tipo_campo as $campo)
                                    <option value="{{$campo->id}}">{{$campo->tipo}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col col-12 col-md-3 col-lg-3 py-1">
                            <label class="font-weight-bold text-dark">Pontuar: </label>
                            <input name="pontuacao" type="number" id="pontuarCampo{{$collapse->id}}"
                                   class='form-control pontuarCampo'
                                   placeholder="PONTUAÇÃO DO CAMPO / VAZIO PARA NÃO PONTUAR" step="0.1"
                                   min="0" max="{{$cargo->escolaridade->formulario->pontuacao}}">
                        </div>


                        <div class="col-12 col-md-3 col-lg-3 py-1">
                            <label class="font-weight-bold text-dark">Digite o Texto
                                slubinhado </label>
                            <input id='placeholder{{$collapse->id}}' type="text" name="placeholder"
                                   class="form-control" onkeyup="place({{$collapse->id}})">
                        </div>

                        <div class="col-12 col-md-3 col-lg3">
                            <div class="form-check form-switch">
                                <input type="checkbox" id="flexSwitchCheckDefault" name="required_campo">
                                <label class="font-weight-bold text-dark" for="flexSwitchCheckDefault">Campo Obrigatório</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-outline-success">Finalizar Registros</button>
            </div>
        </div>
    </div>
    <hr>
</form>


