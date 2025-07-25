<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\CollegeData;
use Modules\Politician\Models\College;
use Modules\Politician\Repositories\CollegeRepository;
use function PHPUnit\Framework\isEmpty;

class CollegeService
{

    public function __construct(
        protected CollegeRepository $collegeRepository
    ){}

    /**
     * @throws \Exception
     */
    public function createCollege(CollegeData $collegeData):  College
    {
        $college = $this->collegeRepository->create($collegeData);

        if(isEmpty($college))
            throw new \Exception('College not created');

        return $college;
    }
}
