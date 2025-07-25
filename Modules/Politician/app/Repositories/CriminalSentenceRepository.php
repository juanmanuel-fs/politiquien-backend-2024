<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\CriminalSentenceData;
use Modules\Politician\Models\CriminalSentence;

class CriminalSentenceRepository
{
    public function create(CriminalSentenceData $criminalSentenceData, $candidateId): ?CriminalSentence
    {
        return CriminalSentence::create([
            'expedient'             => $criminalSentenceData->expedient,
            'date'                  => $criminalSentenceData->date,
            'judicial_authority'    => $criminalSentenceData->judicialAuthority,
            'crime'                 => $criminalSentenceData->crime,
            'ruling'                => $criminalSentenceData->ruling,
            'morality'              => $criminalSentenceData->morality,
            'other_morality'        => $criminalSentenceData->otherMorality,
            'ruling_fulfilled'      => $criminalSentenceData->rulingFulfilled,
            'comment'               => $criminalSentenceData->comment,
            'candidate_id'          => $candidateId,
        ]);
    }
}
