<?php

namespace Modules\Process\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    =>  $this->id,
            'title' =>  $this->title,
            'date'  =>  $this->date,
            'status'=>  $this->status,
            'isCurrent' =>  $this->is_current,
            'elections' =>  $this->elections->pluck('name')
        ];
    }
}
