<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\PostgraduateData;
use Modules\Politician\Models\Postgraduate;
use Modules\Politician\Repositories\PostgraduateRepository;
use function PHPUnit\Framework\isEmpty;

class PostgraduateService
{

    public function __construct(
        protected PostgraduateRepository $postgraduateRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createPostgraduate(PostgraduateData $postgraduateData): Postgraduate
    {
        $postgraduate = $this->postgraduateRepository->create($postgraduateData);

        if(isEmpty($postgraduate))
            throw new \Exception('Postgraduate was not created');

        return $postgraduate;
    }

}
