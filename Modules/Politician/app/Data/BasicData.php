<?php

namespace Modules\Politician\Data;
use Modules\Politician\Enums\LevelBasicEnum;
use Spatie\LaravelData\Data;

class BasicData extends Data
{
    public function __construct(
        public int $concluded,
        public LevelBasicEnum $level,
    ){}
}
