<?php

namespace Modules\Process\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'value'     =>  $this->id,
            'label'     =>  $this->title,
            'relations' =>  $this->elections->pluck('id')
        ];
    }
}
