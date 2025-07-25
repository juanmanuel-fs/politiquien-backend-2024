<?php

namespace Modules\Process\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Process\Data\PositionData;

class StorePositionRequest extends FormRequest
{

    public PositionData $positionData;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'data.attributes.name'          => 'required|string|max:255|unique:elections,name',
            'data.attributes.description'   => 'nullable|string',
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
        $this->positionData = PositionData::from([
            'name'          => $this->data['attributes']['name'],
            'description'   => $this->data['attributes']['description'],
        ]);
    }
}
