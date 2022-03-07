<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'nomeFormulario' => 'required|string|max:100',
            'pontuacaoTotal' => 'required|numeric|min:0|max:100',
            'dataInicio' => 'required',
            'dataFinalizar' => 'required'
        ];
    }
}
