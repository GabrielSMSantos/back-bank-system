<?php

namespace App\Modules\Customer\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindCustomerRequest extends FormRequest
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
        ];
    }

    public function attributes(): array
    {
        return [
            'uuid' => 'Identificador único universal',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O :attribute é obrigatório.',
            'string' => 'O :attribute deve ser um texto.',
        ];
    }
}
