<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\NotCollegeData;
use Modules\Politician\Models\NotCollege;

class NotCollegeRepository
{
    public function create(NotCollegeData $notCollegeData, $candidateId): NotCollege
    {
        return NotCollege::create([
            'institute'     => $notCollegeData->institute,
            'career'        => $notCollegeData->career,
            'concluded'     => $notCollegeData->concluded,
            'candidate_id'  => $candidateId,
        ]);
    }
}
