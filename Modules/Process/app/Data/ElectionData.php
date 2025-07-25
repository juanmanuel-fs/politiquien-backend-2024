<?php

namespace Modules\Process\Data;

use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class ElectionData extends Data
{
    /**
     * @param string $name
     * @param string $description
     * @param Collection $positions
     */
    public function __construct(
        public string $name,
        public string $description,
        /** @var Collection<int, RelationElectionData> */
        public Collection $positions,
    ){}
}

