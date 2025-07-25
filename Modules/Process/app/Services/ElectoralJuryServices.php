<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectoralJuryData;
use Modules\Process\Models\ElectoralJury;
use Modules\Process\Repositories\ElectoralJuryRepository;
use function PHPUnit\Framework\isEmpty;

class ElectoralJuryServices
{
    public function __construct(
        protected ElectoralJuryRepository $electoralJuryRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getElectoralJuries(): Collection
    {
        $electoralJuries = $this->electoralJuryRepository->all();

        if(isEmpty($electoralJuries))
            throw new \Exception("No electoral Juries found");

        return $electoralJuries;
    }

    /**
     * @throws \Exception
     */
    public function getElectoralJury($id): ElectoralJury
    {
        $electoralJury = $this->electoralJuryRepository->find($id);
        if(!$electoralJury)
            throw new \Exception("Electoral Jury not found");

        return $electoralJury;
    }

    /**
     * @throws \Exception
     */
    public function createElectoralJury(ElectoralJuryData $electoralJuryData): ElectoralJury
    {
        $electoralJury = $this->electoralJuryRepository->create($electoralJuryData);
        if(isEmpty($electoralJury))
            throw new \Exception("Electoral Jury not created");

        return $electoralJury;
    }

    /**
     * @throws \Exception
     */
    public function updateElectoralJury($id, ElectoralJuryData $electoralJuryData): ElectoralJury
    {
        $electoralJury = $this->electoralJuryRepository->find($id);
        if(!$electoralJury)
            throw new \Exception("Electoral Jury not updated");

        return $this->electoralJuryRepository->update($electoralJuryData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteElectoralJury($id): ElectoralJury
    {
        $electoralJury = $this->electoralJuryRepository->find($id);
        if(!$electoralJury)
            throw new \Exception("Electoral Jury not deleted");

        $this->electoralJuryRepository->delete($id);

        return $electoralJury;
    }

}
