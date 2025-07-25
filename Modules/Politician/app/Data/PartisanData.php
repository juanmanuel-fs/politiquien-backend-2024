<?php

namespace Modules\Politician\Data;
use Illuminate\Support\Facades\Date;
use Modules\Process\Data\OrganizationData;
use Spatie\LaravelData\Data;

class PartisanData extends Data
{

    public function __construct(
        public ?string $position,
        public ?string $startedAt,
        public ?string $endedAt,
        public ?string $comment,
        public OrganizationData $organization,
    ){}

}
