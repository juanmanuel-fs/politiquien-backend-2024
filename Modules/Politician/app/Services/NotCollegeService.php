<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\NotCollegeData;
use Modules\Politician\Models\NotCollege;
use Modules\Politician\Repositories\NotCollegeRepository;
use function PHPUnit\Framework\isEmpty;

class NotCollegeService
{

    public function __construct(
        protected NotCollegeRepository $notCollegeRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createCollege(NotCollegeData $notCollegeData): NotCollege
    {
        $notCollege = $this->notCollegeRepository->create($notCollegeData);

        if(isEmpty($notCollege))
            throw new \Exception('NotCollege not created');

        return $notCollege;
    }

}
