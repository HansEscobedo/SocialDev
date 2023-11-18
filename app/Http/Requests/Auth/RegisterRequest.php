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
        return [
            'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email' => ['required', 'email', 'unique:users'],
            'birth_date' => ['required', 'date', 'before:today'],
            'password' => ['required', 'alpha_num', 'min:8', 'max:15', 'regex:/^(?=.*[A-Za-zñÑ])(?=.*\d)[A-Za-zñÑ\d,._*+-@!¡¿?&%#|°$]+$/'],
            'last_name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'user_name' => ['required', 'min:2', 'max:12', 'unique:users', 'alpha_num'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.alpha_num' => 'La contraseña solo puede contener letras y números.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña debe tener máximo 15 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una letra y un número.',
            'last_name.required' => 'El campo apellido es obligatorio.',
            'last_name.regex' => 'El apellido solo puede contener letras.',
            'user_name.required' => 'El campo nombre de usuario es obligatorio.',
            'user_name.min' => 'El nombre de usuario debe tener al menos 2 caracteres.',
            'user_name.max' => 'El nombre de usuario debe tener máximo 12 caracteres.',
            'user_name.unique' => 'El nombre de usuario ya se encuentra registrado.',
            'user_name.alpha_num' => 'El nombre de usuario solo puede contener letras y números.',
            'birth_date.required' => 'El campo fecha de nacimiento es obligatorio.',
            'birth_date.date' => 'La fecha de nacimiento debe ser válida.',
            'birth_date.before' => 'La fecha de nacimiento debe ser menor a la actual.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
