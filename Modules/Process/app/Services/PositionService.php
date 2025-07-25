<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PositionData;
use Modules\Process\Models\Position;
use Modules\Process\Repositories\PositionRepository;

class PositionService
{
    public function __construct(
        protected PositionRepository $positionRepository
    ){}

    public function getPositions(): Collection
    {
        return $this->positionRepository->all();
    }

    /**
     * @throws \Exception
     */
    public function getPosition($id): Position
    {
        $position = $this->positionRepository->find($id);

        if(!$position)
        {
            throw new \Exception('Posición no encontrado');
        }

        return $position;
    }

    /**
     * @throws \Exception
     */
    public function createPosition(PositionData $positionData): Position
    {
        if($this->positionRepository->existsSlug($positionData->name))
        {
            throw new \Exception('El Nombre ya existe !!!');
        }

        return $this->positionRepository->create($positionData);
    }

    /**
     * @throws \Exception
     */
    public function updatePosition(PositionData $positionData, $id): Position
    {
        $position = $this->positionRepository->update($positionData, $id);

        if(!$position)
        {
            throw new \Exception('Posición no encontrado');
        }

        return $this->positionRepository->update( $positionData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deletePosition($id): Position
    {
        if(!$this->positionRepository->delete($id))
        {
            throw new \Exception('No se pudo eliminar');
        }
        return $this->positionRepository->delete($id);
    }
}
