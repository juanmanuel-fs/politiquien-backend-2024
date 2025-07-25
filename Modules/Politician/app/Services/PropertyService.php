<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\PropertyData;
use Modules\Politician\Models\Property;
use Modules\Politician\Repositories\PropertyRepository;
use function PHPUnit\Framework\isEmpty;

class PropertyService
{

    public function __construct(
        protected PropertyRepository $propertyRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createProperty(PropertyData $propertyData): Property
    {
        $property = $this->propertyRepository->create($propertyData);

        if(isEmpty($property))
            throw new \Exception('Property was not created');

        return $property;
    }

}
