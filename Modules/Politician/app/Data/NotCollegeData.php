<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class NotCollegeData extends Data
{
    public function __construct(
        public ?string $institute,
        public ?string $career,
        public int $concluded,
    ){}
}
