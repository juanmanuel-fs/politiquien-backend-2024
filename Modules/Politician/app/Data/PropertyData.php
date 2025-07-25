<?php

namespace Modules\Politician\Data;
use Modules\Politician\Enums\TypePropertyEnum;
use Spatie\LaravelData\Data;

class PropertyData extends Data
{
    public function __construct(
        public string $legalPerson,
        public TypePropertyEnum $type,
        public ?float $quantity,
        public ?float $value,
        public ?string $comment,
    ){}
}
