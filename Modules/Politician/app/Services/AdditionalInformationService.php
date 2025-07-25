<?php

namespace Modules\Politician\Services;

use Modules\Politician\Data\AdditionalInformationData;
use Modules\Politician\Models\AdditionalInformation;
use Modules\Politician\Repositories\AdditionalInformationRepository;

class AdditionalInformationService
{
    public function __construct(
        protected AdditionalInformationRepository $additionalInformationRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createAdditionalInformation(AdditionalInformationData $additionalInformationData): AdditionalInformation
    {
        $additionalInformation = $this->additionalInformationRepository->create($additionalInformationData);

        if(!$additionalInformation)
            throw new \Exception('Error creating additional information');

        return $additionalInformation;
    }
}
