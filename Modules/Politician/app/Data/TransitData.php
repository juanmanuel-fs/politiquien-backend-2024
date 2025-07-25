<?php

namespace Modules\Politician\Data;

use Spatie\LaravelData\Data;

class TransitData extends Data
{
    public function __construct(
        public ?string $registration,
        public ?string $misconduct,
        public ?string $description,
        public ?string $comment,
        public string $candidateId
    ){}
}
