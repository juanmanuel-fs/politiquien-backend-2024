<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\PartisanData;
use Modules\Politician\Models\Partisan;
use Modules\Politician\Repositories\PartisanRepository;
use function PHPUnit\Framework\isEmpty;

class PartisanService
{

    public function __construct(
        protected PartisanRepository $partisanRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createOtherPostgraduate(PartisanData $partisanData): Partisan
    {
        $partisan = $this->partisanRepository->create($partisanData);

        if(isEmpty($partisan))
            throw new \Exception('Partisan not created');

        return $partisan;
    }

}
