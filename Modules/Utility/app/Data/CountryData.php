<?php

namespace Modules\Utility\Data;

use Spatie\LaravelData\Data;

class CountryData extends Data
{
    public function __construct(
        public string $name,
        public string $ubigeo,
    ){}
}
