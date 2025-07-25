<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\OccupationData;
use Modules\Politician\Models\Occupation;
use Modules\Politician\Repositories\OccupationRepository;
use function PHPUnit\Framework\isEmpty;

class OccupationService
{
    public function __construct(
        protected OccupationRepository $occupationRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createCollege(OccupationData $occupationData): Occupation
    {
        $occupation = $this->occupationRepository->create($occupationData);

        if(isEmpty($occupation))
            throw new \Exception('Obligatory Sentence not created');

        return $occupation;
    }

}
