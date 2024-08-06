<?php

namespace App\Http\Requests;

use App\Rules\ValidPasswordSymbol;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'min:8', new ValidPasswordSymbol],
            'passwordRepeat' => ['required', 'same:newPassword']
        ];
    }
}
