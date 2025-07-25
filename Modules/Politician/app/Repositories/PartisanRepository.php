<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\PartisanData;
use Modules\Politician\Models\Partisan;
use Modules\Process\Models\Organization;
use Modules\Process\Repositories\OrganizationRepository;

class PartisanRepository
{
    public function create(PartisanData $partisanData, Organization $organization, $candidateId): Partisan
    {

        return Partisan::create([
            'position'          => $partisanData->position,
            'started_at'        => $partisanData->startedAt,
            'ended_at'          => $partisanData->endedAt,
            'comment'           => $partisanData->comment,
            'organization'      => $organization->name,
            'organization_id'   => $organization->id,
            'candidate_id'      => $candidateId,
        ]);
    }

    private function findOrCreate()
    {
    }

}
