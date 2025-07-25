<?php

namespace Modules\Process\Data;

use Spatie\LaravelData\Data;

class PlanData extends Data
{
    public function __construct(
        public string $governmentPlanId,
        public string $experienceCode,
        public string $completeLink,
        public string $summaryLink,
    ){}
}
