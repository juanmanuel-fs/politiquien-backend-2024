<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\BasicData;
use Modules\Politician\Models\Basic;

class BasicRepository
{
    public function create(BasicData $basicData, $candidateId): Basic
    {
        return Basic::create([
            'concluded' => $basicData->concluded,
            'level'     => $basicData->level,
            'candidate_id'  => $candidateId,
        ]);
    }
}
