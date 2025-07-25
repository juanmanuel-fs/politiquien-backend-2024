<?php

namespace Modules\Politician\Data;

use Spatie\LaravelData\Data;

class PoliticianData extends Data
{
    public function __construct(
        public GeneralData $generalData
    ){}
}
