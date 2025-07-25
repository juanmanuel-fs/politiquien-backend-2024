<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\BasicData;
use Modules\Politician\Models\Basic;
use Modules\Politician\Repositories\BasicRepository;
use function PHPUnit\Framework\isEmpty;

class BasicService
{
    public function __construct(
        protected BasicRepository $basicRepository
    ){}

    /**
     * @throws \Exception
     */
    public function createBasic(BasicData $basicData): Basic
    {
        $basic = $this->basicRepository->create($basicData);

        if(isEmpty($basic))
            throw new \Exception('Error creating basic');

        return $basic;
    }
}
