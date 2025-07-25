<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\IncomeData;
use Modules\Politician\Models\Income;

class IncomeRepository
{
    public function create(IncomeData $incomeData, $candidateId): Income
    {
        return Income::create([
            'public_remuneration'   => $incomeData->publicRemuneration,
            'private_remuneration'  => $incomeData->privateRemuneration,
            'public_rent'           => $incomeData->publicRent,
            'private_rent'          => $incomeData->privateRent,
            'public_other'          => $incomeData->publicOther,
            'private_other'         => $incomeData->privateOther,
            'total'                 => $incomeData->total,
            'year'                  => $incomeData->year,
            'candidate_id'          => $candidateId,
        ]);
    }
}
