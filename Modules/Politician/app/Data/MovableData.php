<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class MovableData extends Data
{
    public function __construct(
       public string $vehicle,
       public ?string $brand,
       public ?string $plate,
       public ?string $model,
       public ?string $characteristic,
       public ?int $year,
       public ?float $value,
       public ?string $comment,
    ){}

}
