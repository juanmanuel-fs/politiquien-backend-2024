<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\RenunciationData;
use Modules\Politician\Models\Renunciation;
use Modules\Politician\Repositories\RenunciationRepository;
use function PHPUnit\Framework\isEmpty;

class RenunciationService
{

    public function __construct(
        protected RenunciationRepository $renunciationRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createProperty(RenunciationData $renunciationData): Renunciation
    {
        $renunciation = $this->renunciationRepository->create($renunciationData);

        if(isEmpty($renunciation))
            throw new \Exception('Renunciation was not created');

        return $renunciation;
    }

}
