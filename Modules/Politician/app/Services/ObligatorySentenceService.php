<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\ObligatorySentenceData;
use Modules\Politician\Models\ObligatorySentence;
use Modules\Politician\Repositories\ObligatorySentenceRepository;
use function PHPUnit\Framework\isEmpty;

class ObligatorySentenceService
{

    public function __construct(
        protected ObligatorySentenceRepository $obligatorySentenceRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createCollege(ObligatorySentenceData $obligatorySentenceData): ObligatorySentence
    {
        $obligatorySentence = $this->obligatorySentenceRepository->create($obligatorySentenceData);

        if(isEmpty($obligatorySentence))
            throw new \Exception('Obligatory Sentence not created');

        return $obligatorySentence;
    }

}
