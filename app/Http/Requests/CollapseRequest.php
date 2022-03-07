<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollapseRequest extends FormRequest
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
            'cargo_id' => 'required|exists:App\Models\Cargo,id',
            'nomeCollapse' => 'required|string|min:8|max:100',
        ];
    }
}
