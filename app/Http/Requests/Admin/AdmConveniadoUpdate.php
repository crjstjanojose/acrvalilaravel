<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdmConveniadoUpdate extends FormRequest
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
            'nome' => 'required|min:3|max:255',
            'endereco' => 'required|min:3|max:255',
            'bloco' => 'required|min:1|max:100',
            'apartamento' => 'required|min:1|max:10',
            'telefone' => 'required|min:1|max:10',
        ];
    }
}
