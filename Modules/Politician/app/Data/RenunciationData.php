<?php

namespace Modules\Politician\Data;

use Modules\Process\Data\OrganizationData;
use Spatie\LaravelData\Data;

class RenunciationData extends Data
{
    public function __construct(
        public ?string $endedAt,
        public ?string $comment,
        public OrganizationData $organization,
    ){}

}
