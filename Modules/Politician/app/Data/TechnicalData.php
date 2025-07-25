<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class TechnicalData extends Data
{
    public function __construct(
        public string $institute,
        public string $career,
        public ?int $concluded,
        public ?string $comment,
    ){}

}
