<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        return [ //falta realizar las validaciones especificadas en la ERS
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'last_name' => ['required'],
            'user_name' => ['required']
        ];
    }

    public function messages()
    {
        return [ //tampoco se esta desplegando
            'name.required' => 'El campo nombre es obligatorio.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
