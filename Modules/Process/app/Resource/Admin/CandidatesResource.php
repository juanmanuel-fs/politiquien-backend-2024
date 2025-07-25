<?php

namespace Modules\Process\Resource\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
      $postulation = [];
      if($this->electionable->electionable_type == 'Modules\\Utility\\Models\\District')
      {
          $postulation['state'] = $this->electionable->electionable->province->state->name;
          $postulation['province'] = $this->electionable->electionable->province->name;
          $postulation['district'] = $this->electionable->electionable->name;
      }
      else if($this->electionable->electionable_type == 'Modules\\Utility\\Models\\Province')
      {
          $postulation['state'] = $this->electionable->electionable->state->name;
          $postulation['province'] = $this->electionable->electionable->name;
      }
      else if($this->electionable->electionable_type == 'Modules\\Utility\\Models\\State')
      {
          $postulation['state'] = $this->electionable->electionable->name;
      }
      else
      {
          $postulation['country'] = $this->electionable->electionable->name;
      }

      $postulation['process'] = $this->process->title;
      $postulation['election'] = $this->electionable->election->name;
      $postulation['position'] = $this->position->name;
      $postulation['number'] = $this->number;
      $postulation['organization'] = [
        'name'  =>  $this->organization->name,
        'image' =>  $this->organization->image
      ];

        return [
            'id'    =>  $this->id,
            'fullName'  =>  $this->full_name,
            'image'     =>  $this->image,
            'state'    =>  $this->state,
            'postulation' =>  $postulation
        ];
    }
}
