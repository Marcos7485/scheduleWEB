<?php

namespace App\Http\Requests;

use App\Rules\ValidPasswordSymbol;
use Illuminate\Foundation\Http\FormRequest;

class RegistroPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:20'],
            'telefono' => ['required', 'min:6'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', new ValidPasswordSymbol],
            'passwordRepeat' => ['required', 'same:password']
        ];
    }
}
