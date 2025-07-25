<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionableData;
use Modules\Process\Models\Electionable;
use Modules\Process\Repositories\ElectionableRepository;
use function PHPUnit\Framework\isEmpty;

class ElectionableService
{
    public function __construct(
        protected ElectionableRepository $electionableRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getElectionable($id): Electionable
    {
        $electionable = $this->electionableRepository->find($id);
        if (!$electionable) {
            throw new \Exception('Electionable not found');
        }

        return $electionable;
    }

    /**
     * @throws \Exception
     */
    public function getObjectModelElectionable($model, $id): Electionable
    {
        $electionable = $this->electionableRepository->find($id);
        if (!$electionable) {
            throw new \Exception('Electionable not found');
        }

        return $electionable;
    }

    /**
     * @throws \Exception
     */
    public function getElectionables(): Collection
    {
        $electionables = $this->electionableRepository->all();

        if (isEmpty($electionables)) {
            throw new \Exception('Electionables Empty');
        }

        return $electionables;
    }

    /**
     * @throws \Exception
     */
    public function createElectionable(ElectionableData $electionableData): Electionable
    {
        $electionable = $this->electionableRepository->create($electionableData);

        if (isEmpty($electionable)) {
            throw new \Exception('Electionable not created');
        }

        return $electionable;
    }
}
