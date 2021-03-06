<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TituloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'titulo' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O campo título é de preenchimento obrigatório.',
            'titulo.string' => 'O campo título tem que ser do tipo texto.',
        ]; // TODO: Change the autogenerated stub
    }
}
