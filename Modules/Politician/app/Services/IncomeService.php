<?php

namespace Modules\Politician\services;

use Modules\Politician\Data\IncomeData;
use Modules\Politician\Models\Income;
use Modules\Politician\Repositories\IncomeRepository;
use function PHPUnit\Framework\isEmpty;

class IncomeService
{

    public function __construct(
        protected IncomeRepository $incomeRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function createImmovable(IncomeData $incomeData): Income
    {
        $income = $this->incomeRepository->create($incomeData);

        if(isEmpty($income))
            throw new \Exception('Immovable not created');

        return $income;
    }

}
