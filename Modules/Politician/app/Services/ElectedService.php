<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\ElectedData;
use Modules\Politician\Models\Elected;
use Modules\Politician\Repositories\ElectedRepository;
use function PHPUnit\Framework\isEmpty;

class ElectedService
{
    public function __construct(
        protected ElectedRepository $electedRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createElected(ElectedData $electedData): Elected
    {
        $elected = $this->electedRepository->create($electedData);

        if(isEmpty($elected))
            throw new \Exception('Criminal not created');

        return $elected;
    }
}
