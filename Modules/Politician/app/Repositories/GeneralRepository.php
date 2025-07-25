<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\GeneralData;
use Modules\Politician\Models\General;

class GeneralRepository
{
    public function create(GeneralData $generalData, $candidateId): General
    {
        $general = General::create([
            'dni'           =>  $generalData->dni,
            'name'          =>  $generalData->name,
            'father_surname'=>  $generalData->fatherSurname,
            'mother_surname'=>  $generalData->motherSurname,
            'sex'           =>  $generalData->sex,
            'birth'         =>  $generalData->birth,
            'candidate_id'  =>  $candidateId
        ]);

        $general->address()->create([
            'is_birth'  =>  false,
            'street'    =>  $generalData->address->street,
            'country'   =>  $generalData->address->country,
            'state'     =>  $generalData->address->state,
            'province'  =>  $generalData->address->province,
            'district'  =>  $generalData->address->district,
            'ubigeo'    =>  $generalData->address->ubigeo,
        ]);

        $general->address()->create([
            'is_birth'  =>  true,
            'country'   =>  $generalData->placeBirth->country,
            'state'     =>  $generalData->placeBirth->state,
            'province'  =>  $generalData->placeBirth->province,
            'district'  =>  $generalData->placeBirth->district,
            'ubigeo'    =>  $generalData->placeBirth->ubigeo,
        ]);
        return $general;
    }
}
