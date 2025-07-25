<?php

namespace Modules\Process\Data;

use Spatie\LaravelData\Data;

class RelationElectionData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
    ){}
}

