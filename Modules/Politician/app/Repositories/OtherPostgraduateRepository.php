<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\OtherPostgraduateData;
use Modules\Politician\Models\OtherPostgraduate;

class OtherPostgraduateRepository
{
    public function create(OtherPostgraduateData $otherPostgraduateData, $candidateId): OtherPostgraduate
    {
        return OtherPostgraduate::create([
            'university'    => $otherPostgraduateData->university,
            'specialty'     => $otherPostgraduateData->specialty,
            'concluded'     => $otherPostgraduateData->concluded,
            'is_graduate'   => $otherPostgraduateData->isGraduate,
            'degree'        => $otherPostgraduateData->degree,
            'year_degree'   => $otherPostgraduateData->yearDegree,
            'comment'       => $otherPostgraduateData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
