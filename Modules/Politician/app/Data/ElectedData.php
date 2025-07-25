<?php

namespace Modules\Politician\Data;
use Modules\Process\Data\OrganizationData;
use Spatie\LaravelData\Data;

class ElectedData extends Data
{
    public function __construct(
        public ?string $startedAt,
        public ?string $endedAt,
        public ?string $comment,
        public OrganizationData $organization,
    ){}

}
