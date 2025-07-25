<?php

namespace Modules\Utility\Data;

use Spatie\LaravelData\Data;

class ProvinceData extends Data
{
    public function __construct(
        public string $name,
        public string $ubigeo,
    ){}
}
