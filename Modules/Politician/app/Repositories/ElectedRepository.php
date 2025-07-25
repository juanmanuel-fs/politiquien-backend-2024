<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\ElectedData;
use Modules\Politician\Models\Elected;
use Modules\Process\Models\Organization;

class ElectedRepository
{
    public function create(ElectedData $electedData, Organization $organization ,$positionId, $candidateId): Elected
    {

        return Elected::create([
            'started_at'        => $electedData->startedAt,
            'ended_at'          => $electedData->endedAt,
            'comment'           => $electedData->comment,
            'organization'      => $organization->name,
            'organization_id'   => $organization->id,
            'position_id'       => $positionId,
            'candidate_id'      => $candidateId
        ]);
    }
}
