<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class FiscalData extends Data
{
    public function __construct(
        public ?string $complaint,
        public ?string $state,
        public ?string $crime,
        public ?string $description,
        public ?string $comment,
    ){}
}
