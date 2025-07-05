<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreDeveloperRequest extends FormRequest
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
            'nickname'   => 'required|string|max:32|unique:developers,nickname',
            'name'       => 'required|string|max:100',
            'birth_date' => 'required|date_format:Y-m-d',
            'stack'      => 'nullable|array',
            'stack.*'    => 'required_with:stack|string|max:32',
        ];
    }

    public function messages(): array
    {
        return [
            'nickname.required'   => 'O apelido é obrigatório.',
            'nickname.string'     => 'O apelido deve ser uma string.',
            'nickname.max'        => 'O apelido deve ter no máximo 32 caracteres.',
            'nickname.unique'     => 'Este apelido já está em uso.',
            
            'name.required'       => 'O nome é obrigatório.',
            'name.string'         => 'O nome deve ser uma string.',
            'name.max'            => 'O nome deve ter no máximo 100 caracteres.',

            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date_format' => 'A data de nascimento deve estar no formato YYYY-MM-DD.',

            'stack.array'         => 'A stack deve ser um vetor (array).',
            'stack.*.required_with' => 'Cada tecnologia na stack é obrigatória.',
            'stack.*.string'      => 'Cada item da stack deve ser uma string.',
            'stack.*.max'         => 'Cada tecnologia deve ter no máximo 32 caracteres.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        $hasTypeErrors = collect($errors)->flatten()->contains(function ($message) {
            return str_contains($message, 'deve ser') || str_contains($message, 'must be');
        });

        $status = $hasTypeErrors ? 400 : 422;

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], $status));
    }


}
