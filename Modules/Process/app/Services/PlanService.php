<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PlanData;
use Modules\Process\Models\Plan;
use Modules\Process\Repositories\PlanRepository;
use function PHPUnit\Framework\isEmpty;

class PlanService
{
    public function __construct(
        protected PlanRepository $planRepository
    ){}

    public function getPlans(): Collection
    {
        $plans = $this->planRepository->all();
        if(isEmpty($plans))
            throw new \Exception('Plans Empty');

        return $plans;
    }

    /**
     * @throws \Exception
     */
    public function getPlan($id): Plan
    {
        $plan = $this->planRepository->find($id);
        if(!$plan)
            throw new \Exception('Plan not found');

        return $plan;
    }

    /**
     * @throws \Exception
     */
    public function createPlan(PlanData $planData): Plan
    {
        $plan = $this->planRepository->create($planData);
        if(isEmpty($plan))
            throw new \Exception('Plan not created');

        return $plan;
    }

    /**
     * @throws \Exception
     */
    public function updatePlan(PlanData $planData, $id): Plan
    {
        $plan = $this->planRepository->find($id);
        if(isEmpty($plan))
            throw new \Exception('Plan not updated');

        return $this->planRepository->update($planData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deletePlan($id): Plan
    {
        $plan = $this->planRepository->find($id);
        if(!$plan)
            throw new \Exception('Plan not deleted');

        return $plan;
    }

}
