<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AdministrativeData extends Data
{
    public function __construct(
        public ?string $sanction,
        public ?string $misconduct,
        public ?string $description,
        public ?string $comment,
    ){}

}
