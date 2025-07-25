<?php

namespace Modules\Politician\Data;
use Modules\Utility\Data\AddressData;
use Spatie\LaravelData\Data;

class GeneralData extends Data
{
    public function __construct(
        public string $dni,
        public string $name,
        public string $fatherSurname,
        public string $motherSurname,
        public int $sex,
        public string $birth,
        public AddressData $address,
        public AddressData $placeBirth,
    ){}

}
