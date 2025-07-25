<?php

namespace Modules\Process\Data;

use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class ProcessData extends Data
{
    public function __construct(
        public string $title,
        public ?string $subtitle,
        public ?string $slogan,
        public ?string $description,
        public string $date,
        public bool $status,
        public bool $isCurrent,
        /** @var Collection<int, RelationElectionData> */
        public Collection $elections,
    ){}
}


