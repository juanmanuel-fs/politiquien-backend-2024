<?php

namespace Modules\Process\Resource;

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
            'data' => [
                'type'      => 'process',
                'id'        => $this->id,
                'attributes'    => [
                    'title'         => $this->title,
                    'slug'          => $this->slug,
                    'subtitle'      => $this->subtitle,
                    'slogan'        => $this->slogan,
                    'description'   => $this->description,
                    'calendar'      => $this->calendar,
                    'status'        => $this->status,
                    'is_current'    => $this->is_current,
                ],
            ],
            'relationships' => [
                'elections' => $this->elections
            ],
            'link' => [
                'self'      => route('processes.admin.show', $this->slug),
                'related'   => route('processes.admin.index'),
            ]
        ];
    }
}
