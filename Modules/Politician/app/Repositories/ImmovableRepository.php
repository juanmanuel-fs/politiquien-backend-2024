<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\ImmovableData;
use Modules\Politician\Models\Immovable;

class ImmovableRepository
{
    public function create(ImmovableData $immovableData, $candidateId): Immovable
    {
        return Immovable::create([
            'description'   => $immovableData->description,
            'address'       => $immovableData->address,
            'sunarp'        => $immovableData->sunarp,
            'record_sunarp' => $immovableData->recordSunarp,
            'autovaluo'     => $immovableData->autovaluo,
            'value'         => $immovableData->value,
            'comment'       => $immovableData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
