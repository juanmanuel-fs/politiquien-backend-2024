<?php

namespace Modules\Politician\Data;
use Illuminate\Support\Facades\Date;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CriminalSentenceData extends Data
{
    public function __construct(
        public ?string $expedient,
        public ?string $date,
        public ?string $judicialAuthority,
        public ?string $crime,
        public ?string $ruling,
        public ?string $morality,
        public ?string $otherMorality,
        public ?string $rulingFulfilled,
        public ?string $comment,
    ){}
}
