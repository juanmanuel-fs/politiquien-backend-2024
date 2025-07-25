<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class JudicialData extends Data
{
    public function __construct(
        public ?string $background,
        public ?string $state,
        public ?string $crime,
        public ?string $description,
        public ?string $comment,
    ){}
}
