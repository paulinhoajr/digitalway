<?php

namespace App\Http\Requests\Site;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsuarioUpdateRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'cpf', 'max:14', Rule::unique(Usuario::class)->ignore($this->id)->withoutTrashed()],
            'email' => ['required', 'email', 'max:255', Rule::unique(Usuario::class)->ignore($this->id)->withoutTrashed()],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required_with:password'
        ];
    }

    protected function prepareForValidation()
    {
        //dd($this);
    }
}
