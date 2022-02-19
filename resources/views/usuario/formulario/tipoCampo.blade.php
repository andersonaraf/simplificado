@if(mb_strtoupper($campo->tipoCampo->tipo) != 'SELECIONAR')
    <div class="row   mb-2">
        <label class="font-weight-bold" for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <input type="{{$campo->tipoCampo->tipo == 'Texto' ? 'text' : ($campo->tipoCampo->tipo == 'Arquivo' ? 'file' : ($campo->tipoCampo->tipo == 'Data' ? 'date' : 'Text'))}}" class="form-control" id="{{$campo->atributos->attr_id}}" name="{{$campo->atributos->name}}"
               placeholder="{{!is_null($campo->atributos->placeholder) ? $campo->atributos->placeholder : ''}}" data-id="{{$campo->id}}"
            {{$campo->atributos->required == 1 ? 'required' : ''}}>
    </div>
@else
    <div class="row mb-2">
        <label  class="font-weight-bold" for="{{$campo->atributos->attr_id}}">{{strtoupper($campo->nome)}}:</label>
        <select class="form-control form-group" id="{{$campo->atributos->attr}}"
                name="{{$campo->atributos->name}}" {{$campo->atributos->required == 1 ? 'required' : ''}}>
            @foreach($campo->intemCampo as $item)
                <option value="{{$item->id}}">{{$item->item}}</option>
            @endforeach
        </select>
    </div>
@endif
