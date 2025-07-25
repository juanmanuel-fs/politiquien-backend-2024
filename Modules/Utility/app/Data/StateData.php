<?php

namespace Modules\Utility\Data;

use Spatie\LaravelData\Data;

class StateData extends Data
{
    public function __construct(
        public string $name,
        public string $ubigeo,
    ){}

}
