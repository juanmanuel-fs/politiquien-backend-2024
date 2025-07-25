<?php

namespace Modules\Process\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Process\Data\ProcessData;

class StoreProcessRequest extends FormRequest
{
    public ProcessData $processData;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'data.attributes.title'         => 'required|string|max:255|unique:processes,title',
            'data.attributes.subtitle'      => 'nullable|string|max:255',
            'data.attributes.slogan'        => 'nullable|string',
            'data.attributes.description'   => 'nullable|string',
            'data.attributes.date'          => 'required|date',
            'data.attributes.status'        => 'nullable|boolean',
            'data.attributes.is_current'    => 'nullable|boolean',
            // Relations
            'data.relationships.elections.data'         => ['required', 'array'],
            'data.relationships.elections.data.*.id'    => ['required', 'string', 'exists:elections,id'],
            'data.relationships.elections.data.*.name'  => ['nullable', 'string']
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
        $this->processData = ProcessData::from([
            'title' => $this->data['attributes']['title'],
            'subtitle' => $this->data['attributes']['subtitle'],
            'slogan'=> $this->data['attributes']['slogan'],
            'description'=> $this->data['attributes']['description'],
            'date'=> $this->data['attributes']['date'],
            'status'=> $this->data['attributes']['status'],
            'isCurrent'=> $this->data['attributes']['is_current'],
            'elections'=>$this->collection()
        ]);
    }

    private function collection():array
    {
        $array = [];
        foreach ($this->data['relationships']['elections']['data'] as $election) {
            $array[] = $election;
        }
        return $array;
    }
}
