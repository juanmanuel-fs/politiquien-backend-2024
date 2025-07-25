<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\PostgraduateData;
use Modules\Politician\Models\Postgraduate;
use Modules\Process\Models\Postulation;

class PostgraduateRepository
{
    public function create(PostgraduateData $postgraduateData, $candidateId): Postgraduate
    {
        return Postgraduate::create([
            'university'    => $postgraduateData->university,
            'specialty'     => $postgraduateData->specialty,
            'concluded'     => $postgraduateData->concluded,
            'is_graduate'   => $postgraduateData->isGraduate,
            'degree'        => $postgraduateData->degree,
            'year_degree'   => $postgraduateData->yearDegree,
            'comment'       => $postgraduateData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
