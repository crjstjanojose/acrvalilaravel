<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConvenioUpdate extends FormRequest
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
            'denominacao' => 'required|min:3|max:255',
            'user_id' => [
                'required',
                Rule::unique('convenios', 'user_id')->ignore($this->convenio)
            ],
            'situacao' => 'required'
        ];
    }
}
