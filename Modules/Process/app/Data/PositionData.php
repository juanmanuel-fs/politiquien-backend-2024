<?php

namespace Modules\Process\Data;

use Spatie\LaravelData\Data;

class PositionData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
    ){}
}
