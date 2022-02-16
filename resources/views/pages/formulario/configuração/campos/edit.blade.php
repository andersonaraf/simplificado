@if(mb_strtoupper($campo->tipoCampo->tipo) != 'SELECIONAR')
    <div class="has-info row">
        <div class="col-6">
            <label for="{{$campo->atributos->attr_id}}"
                   class="text-dark font-weight-bold ocultar{{$campo->id}}">{{mb_strtoupper($campo->nome)}}</label>
            <input class="form-control edit_input{{$campo->id}}" id="nome{{$campo->id}}" type="text" value="{{$campo->nome}}" style="display: none">
            <input
                type="{{$campo->tipoCampo->tipo == 'Texto' ? 'text' : ($campo->tipoCampo->tipo == 'Arquivo' ? 'file' : ($campo->tipoCampo->tipo == 'Data' ? 'date' : 'Text'))}}"
                class="form-control" id="{{$campo->atributos->attr_id}}"
                placeholder="{{mb_strtoupper($campo->atributos->placeholder)}}" disabled>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col col-8">
                    @if($campo->pontuar == 1)
                        <label for="editar{{$campo->id}}" class="text-dark font-weight-bold ">PONTUAÇÃO</label>
                        <input type="number" class="form-control" name="editar{{$campo->id}}" id="editar{{$campo->id}}"
                               value="{{$campo->ponto}}" step="0.1" min="0" max="100" disabled>
                    @endif
                </div>

                <div class="col col-4 text-right">
                    <a href="javascript:void(0);" class="edit_item_sweet"
                       data-action="" title="EDITAR O CAMPO" onclick="editarCampo({{$campo->id}})">
                        <span class="material-icons text-info">edit</span>
                    </a>

                    <a href="javascript:void(0);" class="delete_item_sweet"
                       data-action="{{route('campo.destroy', $campo->id)}}" title="REMOVER O CAMPO">
                        <span class="material-icons text-warning">delete</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row edit_input{{$campo->id}}" style="display:none">
            <div class="col text-right">
                <button id="update{{$campo->id}}" onclick="editarInput({{$campo->id}})" data-action="{{route('editar.campo', $campo->id)}}"class="btn btn-outline-info">Editar</button>
            </div>
        </div>
    </div>
@else
    <div class="has-info row">
        <div class="col-6">
            <label for="{{$campo->atributos->attr_id}}"
                   class="text-dark font-weight-bold">{{mb_strtoupper($campo->nome)}}</label>
            <select class="form-control" id="{{$campo->atributos->attr_id}}" name="editar{{$campo->id}}">
                @foreach($campo->intemCampo as $item)
                    <option value="{{$item->id}}">{{$item->item}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col col-8">
                    @if($campo->pontuar == 1)
                        <label for="editar{{$campo->id}}" class="text-dark font-weight-bold ">PONTUAÇÃO</label>
                        <input type="number" class="form-control" name="editar{{$campo->id}}" id="editar{{$campo->id}}"
                               value="{{$campo->ponto}}" step="0.1" min="0" max="100" disabled>
                    @endif
                </div>

                <div class="col col-4 text-right">
                    <a href="#" class="adicioanar_item"
                       data-action="{{route('cadastrar.itemSelect')}}" data-campo-id="{{$campo->id}}"
                       title="ADICIONAR ITEM">
                        <span class="material-icons text-primary">plus_one</span>
                    </a>

                    <a href="javascript:void(0);" class="delete_item_sweet"
                       data-action="{{route('campo.destroy', $campo->id)}}" title="REMOVER O CAMPO">
                        <span class="material-icons text-warning">delete</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endif

