<?php

namespace Modules\Politician\Repositories;

use Modules\Politician\Data\ObligatorySentenceData;
use Modules\Politician\Models\ObligatorySentence;

class ObligatorySentenceRepository
{
    public function create(ObligatorySentenceData $obligatorySentenceData, $candidateId): ObligatorySentence
    {
        return ObligatorySentence::create([
            'expedient'         => $obligatorySentenceData->expedient,
            'matter'            => $obligatorySentenceData->matter,
            'judicial_authority'=> $obligatorySentenceData->judicialAuthority,
            'ruling'            => $obligatorySentenceData->ruling,
            'comment'           => $obligatorySentenceData->comment,
            'candidate_id'      => $candidateId
        ]);
    }
}
