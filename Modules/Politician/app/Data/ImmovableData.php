<?php

namespace Modules\Politician\Data;

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class ImmovableData extends Data
{
    public function __construct(
        public string $description,
        public string $address,
        public ?int $sunarp,
        public ?string $recordSunarp,
        public ?float $autovaluo,
        public ?float $value,
        public ?string $comment,
    ){}

}
