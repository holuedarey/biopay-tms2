<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'host' => 'string',
            'port' => 'digits_between:4,6',
            'ssl'  => 'bool',
            'requiresKey'  => 'bool',
            'comp1' => 'string',
            'comp2' => 'string',
            'zpk' => 'nullable|string',
        ];
    }
}
