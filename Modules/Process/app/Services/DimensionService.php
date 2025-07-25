<?php

namespace Modules\Process\Services;

use Modules\Process\Data\DimensionData;
use Modules\Process\Models\Dimension;
use Modules\Process\Repositories\DimensionRepository;
use function PHPUnit\Framework\isEmpty;

class DimensionService
{
    public function __construct(
        protected DimensionRepository $dimensionRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getDimension($id): Dimension
    {
        $dimension = $this->dimensionRepository->find($id);
        if(!$dimension)
            throw new \Exception('Plan not found');

        return $dimension;
    }

    /**
     * @throws \Exception
     */
    public function createDimension(DimensionData $dimensionData): Dimension
    {
        $dimension = $this->dimensionRepository->create($dimensionData);
        if(isEmpty($dimension))
            throw new \Exception('Plan not created');

        return $dimension;
    }

    /**
     * @throws \Exception
     */
    public function updateDimension(DimensionData $dimensionData, $id): Dimension
    {
        $dimension = $this->dimensionRepository->find($id);
        if(isEmpty($dimension))
            throw new \Exception('Plan not updated');

        return $this->dimensionRepository->update($dimensionData, $id);
    }

}
