<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PlanData;
use Modules\Process\Models\Plan;

interface PlanRepositoryInterface
{
    public function all(): ?Collection;
    public function find(int $id): ?Plan;
    public function create(PlanData $planData): ?Plan;
    public function update(PlanData $planData, int $id): Plan;
    public function delete(int $id): bool;
}
