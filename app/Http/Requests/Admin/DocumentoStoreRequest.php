<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'escola_id' => ['nullable'],
            'cidade_id' => ['nullable'],
            'nome' => ['required'],
            'pdf' => ['nullable', 'max:4096'],
            'descricao' => ['required'],
            'situacao' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {

    }
}
