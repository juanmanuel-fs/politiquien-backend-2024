<?php

namespace Modules\Politician\Data;

use Spatie\LaravelData\Data;

class IncomeData extends Data
{
    public function __construct(
        public ?float $publicRemuneration,
        public ?float $privateRemuneration,
        public ?float $publicRent,
        public ?float $privateRent,
        public ?float $publicOther,
        public ?float $privateOther,
        public ?float $total,
        public ?int $year,
    ) {}

}
