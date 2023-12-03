<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
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
            'title'=>['required'],
            'description'=>['required'],
            'image_path'=>['required'],
            'likes'=>['required', 'numeric'],
            'comments'=>['required', 'numeric'],
            'user_id'=>['required'],
        ];
    }

    public function messages()
    {
        return [ //No se estan desplegando estos mensajes, preguntar al Diego porque
            'title.required' => 'El campo título es obligatorio.',
            'description.required' => 'El campo descripción es obligatorio.',
            'image_path.required' => 'El campo imagen es obligatorio.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
