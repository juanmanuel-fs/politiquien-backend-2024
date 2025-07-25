<?php

namespace Modules\Process\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Process\Data\ProcessData;

class UpdateProcessRequest extends FormRequest
{
    public ProcessData $processData;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:255', 'unique:processes,title,'.$this->id],
            'subtitle'      => ['nullable', 'string', 'max:255'],
            'slogan'        => ['nullable', 'string'],
            'description'   => ['nullable', 'string'],
            'date'          => ['required', 'date'],
            'status'        => ['nullable', 'boolean'],
            'is_current'    => ['nullable', 'boolean'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function passedValidation(): void
    {
        $this->processData = ProcessData::from($this->validated());
    }
}
