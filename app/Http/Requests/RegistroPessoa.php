<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroPessoa extends FormRequest
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
            'nomeCompleto' => 'required|string|max:100',
            'nomeSocial' => 'nullable|string|max:100|min:0',
            'cpf' => 'required|string|max:100|min:0',
            'rg' => 'required|string|max:100|min:0',
            'orgaoExpedidor' => 'required|string|max:100|min:0',
            'contato1' => 'required|celular_com_ddd',
            'contato2' => 'nullable|celular_com_ddd',
            'genero' => 'required|exists:App\Models\Genero,id',
            'pne' => 'required|boolean',
            'cep' => 'required|formato_cep',
            'bairro' => 'required|string|max:150',
            'rua' => 'required|string|max:150',
            'numero' => 'nullable|string|max:150',
            'complemento' => 'nullable|string|max:150',
            'email' => 'required|string|max:150|email|unique:App\User,email',
            'password' => 'required|string|max:80|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'contato1.required' => 'O campo de contato (1) é obrigatório.',
            'contato1.celular_com_ddd' => 'O campo de contato (1) precisa está no formato exigido.',
            'contato2.required' => 'O campo de contato (2) é obrigatório.',
            'contato2.celular_com_ddd' => 'O campo de contato (2) precisa está no formato exigido.',
            'genero.required' => 'O campo gênero é obrigatório.',
            'pne.boolean' => 'O campo pne só poder ser sim ou não.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha é precisa de no mínimo oito caracteres.',
            'password.max' => 'O campo senha é aceita no máximo 80 caracteres.',
            'password.confirmed' => 'As senhas são divergentes.',
        ]; // TODO: Change the autogenerated stub
    }
}