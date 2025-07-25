<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\RenunciationData;
use Modules\Politician\Models\Renunciation;
use Modules\Process\Models\Organization;

class RenunciationRepository
{
    public function create(RenunciationData $renunciationData, Organization $organization, $candidateId): Renunciation
    {
        return Renunciation::create([
            'ended_at'          => $renunciationData->endedAt,
            'comment'           => $renunciationData->comment,
            'organization'      => $organization->name,
            'organization_id'   => $organization->id,
            'candidate_id'      => $candidateId,
        ]);
    }
}
