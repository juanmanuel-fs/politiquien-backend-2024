<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\OtherPostgraduateData;
use Modules\Politician\Models\OtherPostgraduate;
use Modules\Politician\Repositories\OtherPostgraduateRepository;
use function PHPUnit\Framework\isEmpty;

class OtherPostgraduateService
{

    public function __construct(
        protected OtherPostgraduateRepository $otherPostgraduateRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createOtherPostgraduate(OtherPostgraduateData $otherPostgraduateData): OtherPostgraduate
    {
        $otherPostgraduate = $this->otherPostgraduateRepository->create($otherPostgraduateData);

        if(isEmpty($otherPostgraduate))
            throw new \Exception('Other Postgraduate not created');

        return $otherPostgraduate;
    }

}
