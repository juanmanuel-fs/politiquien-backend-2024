<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PlanData;
use Modules\Process\interfaces\PlanRepositoryInterface;
use Modules\Process\Models\Plan;

class PlanRepository implements PlanRepositoryInterface
{
    public function all(): ?Collection
    {
        return Plan::all();
    }

    public function find($id): ?Plan
    {
        return Plan::find($id);
    }

    public function create(PlanData $planData): ?Plan
    {
        return Plan::create($planData);
    }

    public function update(PlanData $planData, $id): Plan
    {
        $plan = Plan::find($id);
        $plan->update($planData);
        $plan->touch();

        return $plan;
    }

    public function delete($id): bool
    {
        return Plan::destroy($id);
    }
}
