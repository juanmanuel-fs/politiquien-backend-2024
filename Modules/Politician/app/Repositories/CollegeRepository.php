<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\CollegeData;
use Modules\Politician\Models\College;

class CollegeRepository
{
    public function create(CollegeData $collegeData, $candidateId): College
    {
        return College::create([
            'university'    => $collegeData->university,
            'career'        => $collegeData->career,
            'concluded'     => $collegeData->concluded,
            'is_graduate'   => $collegeData->isGraduate,
            'year_graduate' => $collegeData->yearGraduate,
            'degree'        => $collegeData->degree,
            'year_degree'   => $collegeData->yearDegree,
            'comment'       => $collegeData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
