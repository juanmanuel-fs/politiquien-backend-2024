<?php

namespace Modules\Process\Data;

use Modules\Process\Enums\DimensionEnum;
use Spatie\LaravelData\Data;

class DimensionData extends Data
{
    public function __construct(
        public DimensionEnum $dimensionEnum,
        public string $problem,
        public string $objective,
        public string $indicator,
        public string $goal,
        public int $planId
    ){}

}
