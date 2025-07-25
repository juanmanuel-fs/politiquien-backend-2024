<?php

namespace Modules\Utility\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'value'    =>  $this->id,
            'label' =>  $this->name,
        ];
    }
}
