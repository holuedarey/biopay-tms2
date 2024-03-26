<?php

namespace App\Http\Requests;

use App\Models\KycLevel;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateLevelRequest extends FormRequest
{
    public User $agent;
    public KycLevel $level;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->agent = $this->user ?? $this->user();

        return $this->user()->can('update', $this->agent);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'level_id' => 'exists:kyc_levels,id'
        ];
    }

    protected function passedValidation(): void
    {
        $this->level = KycLevel::find($this->integer('level_id'));

        $this->validateBvnLevel();
        $this->validateDocumentLevels();

        // Update user level after validations pass
        $this->agent->update(['level_id' => $this->integer('level_id')]);
    }

    /**
     * If BVN is required to update to the level
     *
     * @return void
     */
    protected function validateBvnLevel(): void
    {
        if ($this->level_id == 2 && is_null($this->agent->bvn)) {
            throw ValidationException::withMessages([
                'level_id' => "BVN needs to be added for this level. {$this->msg()}"
            ]);
        }
    }

    /**
     * If id or utility bill is required for the level
     *
     * @return void
     */
    protected function validateLevel3(): void
    {
        if ($this->level_id == 3 && (!$this->agent->hasVerifiedDocsForLevel3())) {
            throw ValidationException::withMessages([
                'level_id' => "{$this->level->required_doc} is required to be updated to this level. {$this->msg()}"
            ]);
        }
    }

    /**
     * If id or utility bill is required for the level
     *
     * @return void
     */
    protected function validateLevel4(): void
    {
        if ($this->level_id == 4 && (! $this->agent->hasVerifiedDocsForLevel4())) {
            throw ValidationException::withMessages([
                'level_id' => "{$this->level->required_doc} is required to be updated to this level. {$this->msg()}"
            ]);
        }
    }

    protected function msg(): string
    {
        return $this->agent->is($this->user()) ? 'Please contact support!' : '';
    }

    private function validateDocumentLevels(): void
    {
        if (!in_array($this->level->id, [1, 2])) {
            $documentIds = $this->level->documents()->pluck('id')->toArray();

            if ($this->agent->kyc()
                ->whereIn('document_id', $documentIds)
                ->whereNotNull('verified_at')
                ->doesntExist()
            ) {
                throw ValidationException::withMessages([
                    'level_id' => "{$this->level->required_doc} is required to be upgraded to this level. {$this->msg()}"
                ]);
            }
        }
    }
}
