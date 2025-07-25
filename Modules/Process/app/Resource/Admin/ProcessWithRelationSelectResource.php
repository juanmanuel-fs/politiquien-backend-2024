<?php

namespace Modules\Process\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessWithRelationSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'value'         =>  $this->id,
            'label'         =>  $this->title,
            'elections'     =>  $this->elections->pluck('id'),
            'organizations' =>  $this->postulations->pluck('organization_id')->unique()->values()->all()
        ];
    }
}
