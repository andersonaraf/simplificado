<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerfilUser extends FormRequest
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
            'password' => 'required|min:6',
            'password2' => 'required|min:6',
            'email' => 'unique:users',
        ];
    }

    public function messages()
    {
        return
            [
                'password.required' => 'Este campo é obrigatório',
                'password2.required' => 'Este campo é obrigatório',
                'password.min' => 'Este campo deve conter no minimo :min caracteres',
                'password2.min' => 'Este campo deve conter no minimo :min caracteres',
                'email.email' => 'Este campo deve conter um email válido',
                'email.unique' => 'Este email já está sendo utilizado'
            ];
    }
}
