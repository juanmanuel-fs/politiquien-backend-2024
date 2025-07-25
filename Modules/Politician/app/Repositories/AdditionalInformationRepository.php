<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\AdditionalInformationData;
use Modules\Politician\Models\AdditionalInformation;

class AdditionalInformationRepository
{
    public function create(AdditionalInformationData $additionalInformationData, $candidateId): ?AdditionalInformation
    {
        return AdditionalInformation::create([
            'additional'    =>  $additionalInformationData->additional,
            'candidate_id'  =>  $candidateId
        ]);
    }
}
