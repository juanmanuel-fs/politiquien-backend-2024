<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\PropertyData;
use Modules\Politician\Models\Property;

class PropertyRepository
{
    public function create(PropertyData $propertyData, $candidateId): Property
    {
        return Property::create([
            'legal_person'  => $propertyData->legalPerson,
            'type'          => $propertyData->type,
            'quantity'      => $propertyData->quantity,
            'value'         => $propertyData->value,
            'comment'       => $propertyData->comment,
            'candidate_id'  => $candidateId,
        ]);
    }
}
