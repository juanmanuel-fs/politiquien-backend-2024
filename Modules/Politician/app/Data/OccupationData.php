<?php

namespace Modules\Politician\Data;
use Modules\Utility\Data\AddressData;
use Spatie\LaravelData\Data;

class OccupationData extends Data
{
    public function __construct(
        public string $workplace,
        public string $occupation,
        public ?string $ruc,
        public ?string $startedAt,
        public ?string $endedAt,
        public ?string $comment,
        public AddressData $address,
    ){}
}
