<?php

namespace Modules\Process\Data;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class OrganizationData extends Data
{
    public function __construct(
        public ?int $jneId,
        public string $name,
        public ?string $description,
        public ?string $image,
        public ?int $type,
        public ?int $registeredAt,
        public ?string $phone1,
        public ?string $phone2,
        public ?string $website,
        public ?string $email,
        public ?string $holder,
        public ?string $alternate,
        public ?int $registered,
        public ?string $comment,
        public ?int $state,
        public ?bool $status,
    ){}
}

