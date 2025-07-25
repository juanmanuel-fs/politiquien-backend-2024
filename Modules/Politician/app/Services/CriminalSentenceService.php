<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\CriminalSentenceData;
use Modules\Politician\Models\CriminalSentence;
use Modules\Politician\Repositories\CriminalSentenceRepository;
use function PHPUnit\Framework\isEmpty;

class CriminalSentenceService
{
    public function __construct(
        protected CriminalSentenceRepository $criminalSentenceRepository
    ){}

    /**
     * @throws \Exception
     */
    public function createCriminalSentence(CriminalSentenceData $criminalSentenceData): CriminalSentence
    {
        $criminal = $this->criminalSentenceRepository->create($criminalSentenceData);

        if(isEmpty($criminal))
            throw new \Exception('Criminal not created');

        return $criminal;
    }
}
