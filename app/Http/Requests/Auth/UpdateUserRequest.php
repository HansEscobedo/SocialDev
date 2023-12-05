<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'name'=>['required'],
            'last_name'=>['required'],
            'password'=>['required','alpha_num', 'min:8', 'max:15', 'regex:/^(?=.*[A-Za-zñÑ])(?=.*\d)[A-Za-zñÑ\d,._*+-@!¡¿?&%#|°$]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'last_name.required' => 'El campo apellido es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.alpha_num' => 'La contraseña solo puede contener letras y números.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña debe tener máximo 15 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una letra y un número.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
