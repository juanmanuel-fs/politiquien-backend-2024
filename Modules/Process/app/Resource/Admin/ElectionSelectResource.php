<?php

namespace Modules\Process\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectionSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'value'    =>  $this->id,
            'label'     =>  $this->name,
            'relations' =>  $this->positions->pluck('id')
        ];
    }
}
