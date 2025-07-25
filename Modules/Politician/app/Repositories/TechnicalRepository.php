<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\TechnicalData;
use Modules\Politician\Models\Technical;

class TechnicalRepository
{
    public function create(TechnicalData $technicalData, $candidateId): Technical
    {
        return Technical::create([
            'institute'     => $technicalData->institute,
            'career'        => $technicalData->career,
            'concluded'     => $technicalData->concluded,
            'comment'       => $technicalData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
