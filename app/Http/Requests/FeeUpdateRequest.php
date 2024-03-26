<?php

namespace App\Http\Requests;

use App\Models\Fee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FeeUpdateRequest extends FormRequest
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
            'amount' => ['numeric', 'min:0', Rule::when($this->amount_type == Fee::PERCENT, 'max:50')],
            'amount_type' => [Rule::in(Fee::amountTypes())],
            'info' => 'nullable',
            'cap' => [Rule::when(
                $this->amount_type != Fee::FIXED,
                'required|not_in:0'
            ), 'numeric'],
            'config' => $forConfig = Rule::requiredIf($this->amount_type == Fee::CONFIG),
            'config.*.range' => [$forConfig, 'regex:/^\d+\-\d+$/'],
            'config.*.amount' => [$forConfig, 'numeric', 'not_in:0'],
            'structure.*' => 'numeric'
        ];
    }

    protected function passedValidation(): void
    {
        $this->validateAmountTypeForCommission();

        $this->validateConfigValues();

        $this->validateCommissionStructure();

        // Update the given fee.
        $this->fee->update($this->validated());
    }

    /**
     * Validate that the amount type is percentage for commission fee.
     *
     * @return void
     */
    private function validateAmountTypeForCommission(): void
    {
        $this->whenHas('amount_type', function () {
            if ($this->fee->isCommission() && $this->amount_type == Fee::CONFIG) {
                throw ValidationException::withMessages([
                    'amount_type' => 'Invalid amount type.'
                ]);
            }
        });
    }

    /**
     * Validate the values in the config input when it is filled.
     *
     * @return void
     */
    private function validateConfigValues(): void
    {
        $this->whenFilled('config', function () {
            foreach ($this->config as $config) {
                $min = (int) str($config['range'])->before('-')->trim()->value();
                $max = (int) str($config['range'])->afterLast('-')->trim()->value();

                if ($min > $max) throw ValidationException::withMessages([
                    'config.*.range' => __('validation.custom.config.*.range.regex', ['value' => $config['range']])
                ]);
            }
        });
    }

    private function validateCommissionStructure(): void
    {
        $this->whenFilled('structure', function () {
            if ($this->amount_type == Fee::FIXED) {
                if ($this->structure['for_agent'] + $this->structure['for_super_agent'] != $this->amount) {
                    throw ValidationException::withMessages([
                        'structure' => 'The sum of the sharing structure must be equal to the amount.'
                    ]);
                }
            }

            if ($this->amount_type == Fee::PERCENT) {
                if ($this->structure['for_agent'] + $this->structure['for_super_agent'] != 100) {
                    throw ValidationException::withMessages([
                        'structure' => 'The sum of the sharing structure must be 100%.'
                    ]);
                }
            }
        });
    }
}
