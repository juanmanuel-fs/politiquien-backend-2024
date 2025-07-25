<?php

namespace Modules\Politician\Services;

use Modules\Politician\Data\GeneralData;
use Modules\Politician\Models\General;
use Modules\Politician\Repositories\GeneralRepository;
use function PHPUnit\Framework\isEmpty;

class GeneralService
{

    public function __construct(
        protected GeneralRepository $generalRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createGeneral(GeneralData $generalData): General
    {
        $elected = $this->generalRepository->create($generalData);

        if(isEmpty($elected))
            throw new \Exception('General not created');

        return $elected;
    }

}
