<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\MovableData;
use Modules\Politician\Models\Movable;

class MovableRepository
{
    public function create(MovableData $movableData, $candidateId): Movable
    {
        return Movable::create([
            'vehicle'           => $movableData->vehicle,
            'brand'             => $movableData->brand,
            'plate'             => $movableData->plate,
            'model'             => $movableData->model,
            'characteristic'    => $movableData->characteristic,
            'year'              => $movableData->year,
            'value'             => $movableData->value,
            'comment'           => $movableData->comment,
            'candidate_id'      => $candidateId
        ]);
    }
}
