<?php

namespace Modules\Process\Data;

use Spatie\LaravelData\Data;
use Modules\Process\Enums\StateCandidateEnum;
use Modules\Process\Models\Organization;

class PostulationData extends Data
{
    public function __construct(
        public int $jneProcessId,
        public int $jneElectionId,
        public ?string $department,
        public ?string $province,
        public ?string $district,
        public ?string $ubigeo,
        public string $position,
        public StateCandidateEnum $state,
        public OrganizationData $organization,
        public int $number,

    ){}
}
