<?php

namespace Modules\Utility\Data;

use Spatie\LaravelData\Data;

class AddressData extends Data
{

    public function __construct(
        public ?string $street,
        public ?string $country,
        public ?string $state,
        public ?string $province,
        public ?string $district,
        public ?string $ubigeo,
        public bool $isBirth,
    ){}
}
