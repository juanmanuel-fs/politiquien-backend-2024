<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\MovableData;
use Modules\Politician\Models\Movable;
use Modules\Politician\Repositories\MovableRepository;
use function PHPUnit\Framework\isEmpty;

class MovableService
{

    public function __construct(
        protected MovableRepository $movableRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createMovable(MovableData $movableData): Movable
    {
        $mavable = $this->movableRepository->create($movableData);

        if(isEmpty($mavable))
            throw new \Exception('Movable not created');

        return $mavable;
    }

}
