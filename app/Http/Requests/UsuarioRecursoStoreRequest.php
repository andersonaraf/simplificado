<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRecursoStoreRequest extends FormRequest
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
            'arquivo' => 'required|mimes:pdf|max:5120',
            'texto' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'arquivo.required' => 'O arquivo é obrigatório.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O arquivo deve ter no máximo 5MB.',
            'texto.required' => 'O texto é obrigatório.',
            'texto.max' => 'O texto deve ter no máximo 1000 caracteres.',
        ];
    }
}
