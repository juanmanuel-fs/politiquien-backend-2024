<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\TechnicalData;
use Modules\Politician\Models\Technical;
use Modules\Politician\Repositories\TechnicalRepository;
use function PHPUnit\Framework\isEmpty;

class TechnicalService
{

    public function __construct(
        protected TechnicalRepository $technicalRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createTechnical(TechnicalData $technicalData): Technical
    {
        $technical = $this->technicalRepository->create($technicalData);

        if(isEmpty($technical))
            throw new \Exception('Technical was not created');

        return $technical;
    }

}
