<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\OccupationData;
use Modules\Politician\Models\Occupation;

class OccupationRepository
{
    public function create(OccupationData $occupationData, $candidateId): Occupation
    {
        $occupation = Occupation::create([
            'workplace'     => $occupationData->workplace,
            'occupation'    => $occupationData->occupation,
            'ruc'           => $occupationData->ruc,
            'started_at'    => $occupationData->startedAt,
            'ended_at'      => $occupationData->endedAt,
            'comment'       => $occupationData->comment,
            'candidate_id'  => $candidateId
        ]);

        if($occupationData->address->ubigeo)
        {
            $occupation->addresses()->create([
                'is_birth'  =>  false,
                'street'    =>  $occupationData->address->street,
                'country'   =>  $occupationData->address->country,
                'state'     =>  $occupationData->address->state,
                'province'  =>  $occupationData->address->province,
                'district'  =>  $occupationData->address->district,
                'ubigeo'    =>  $occupationData->address->ubigeo,
            ]);
        }

        return $occupation;
    }
}
