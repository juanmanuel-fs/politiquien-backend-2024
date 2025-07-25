<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\ImmovableData;
use Modules\Politician\Models\Immovable;
use Modules\Politician\Repositories\ImmovableRepository;
use function PHPUnit\Framework\isEmpty;

class ImmovableService
{

    public function __construct(
        protected ImmovableRepository $immovableRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createImmovable(ImmovableData $immovableData): Immovable
    {
        $immovable = $this->immovableRepository->create($immovableData);

        if(isEmpty($immovable))
            throw new \Exception('Immovable not created');

        return $immovable;
    }

}
