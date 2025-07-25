<?php

namespace Modules\Politician\Data;

use Spatie\LaravelData\Data;

class AdditionalInformationData extends Data
{
    public function __construct(
        public string $additional,
    ){}
}
