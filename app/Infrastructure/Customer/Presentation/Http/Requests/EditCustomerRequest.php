<?php

namespace App\Infrastructure\Customer\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomerRequest extends FormRequest
{
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
            'uuid' => 'required|string',
            'cpf' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string',
            'cell' => 'required|string',
            'birthDate' => 'required|date',
        ];
    }

    public function attributes(): array
    {
        return [
            'uuid' => 'Identificador único universal',
            'cpf' => 'Cpf',
            'firstName' => 'Nome',
            'lastName' => 'Sobrenome',
            'email' => 'E-Mail',
            'cell' => 'Celular',
            'birthDate' => 'Data de nascimento'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O :attribute é obrigatório.',
            'string' => 'O :attribute deve ser um texto.',
            'date' => 'O :attribute deve ser uma data válida.',
        ];
    }
}
