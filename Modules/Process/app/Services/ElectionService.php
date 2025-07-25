<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionData;
use Modules\Process\Models\Election;
use Modules\Process\Repositories\ElectionRepository;

class ElectionService
{
    public function __construct(
        private ElectionRepository $electionRepository
    ){}

    public function getElections(): Collection
    {
        return $this->electionRepository->all();
    }

    public function getForProcess($ids): Collection 
    {
        $elections = $this->electionRepository->allForProcess($ids);
        if(!$elections)
        {
            throw new \Exception('Elecciones no encontrado');
        }
        return $elections;
    }

    /**
     * @throws \Exception
     */
    public function getElection($id): Election
    {
        $election = $this->electionRepository->find($id);

        if(!$election)
        {
            throw new \Exception('Elección no encontrado');
        }

        return $election;
    }

    /**
     * @throws \Exception
     */
    public function createElection(ElectionData $electionData): Election
    {
        if($this->electionRepository->existsSlug($electionData->name))
        {
            throw new \Exception('El título ya existe !!!');
        }

        return $this->electionRepository->create($electionData);
    }

    /**
     * @throws \Exception
     */
    public function updateElection(ElectionData $electionData, $id): Election
    {
        $election = $this->electionRepository->update($electionData, $id);

        if(!$election)
        {
            throw new \Exception('Elección no encontrado');
        }

        return $this->electionRepository->update( $electionData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteElection($id): Election
    {
        if(!$this->electionRepository->delete($id))
        {
            throw new \Exception('No se pudo eliminar');
        }
        return $this->electionRepository->delete($id);
    }
}
