<?php

namespace Modules\Process\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Process\Data\ElectionData;

class StoreElectionRequest extends FormRequest
{
    public ElectionData $electionData;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'data.attributes.name'          => ['required', 'string', 'max:255', 'unique:elections,name'],
            'data.attributes.description'   => ['nullable', 'string'],
            // Relation
            'data.relationships.positions.data'          => ['nullable', 'array'],
            'data.relationships.positions.data.*.id'     => ['required', 'string', 'exists:positions,id'],
            'data.relationships.positions.data.*.name'   => ['nullable', 'string'],
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
        $this->electionData = ElectionData::from([
            'name' => $this->input('data.attributes.name'),
            'description' => $this->input('data.attributes.description'),
            'positions' => $this->input('data.relationships.positions.data'),
        ]);
    }
}
