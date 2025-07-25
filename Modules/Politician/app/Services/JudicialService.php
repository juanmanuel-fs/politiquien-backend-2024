<?php

namespace Modules\Politician\services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\JudicialData;
use Modules\Politician\Models\Judicial;
use Modules\Politician\Repositories\JudicialRepository;
use function PHPUnit\Framework\isEmpty;

class JudicialService
{
    public function __construct(
        protected JudicialRepository $judicialRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function getJudicial($id): Judicial
    {
        $judicial = $this->judicialRepository->find($id);

        if(!$judicial)
            throw new \Exception('Judicial not found');

        return $judicial;
    }

    /**
     * @throws \Exception
     */
    public function getJudicials(): ?Collection
    {
        $judicials = $this->judicialRepository->all();

        if(isEmpty($judicials))
            throw new \Exception('Judicials not found');

        return $judicials;
    }

    /**
     * @throws \Exception
     */
    public function createJudicial(JudicialData $judicialData): Judicial
    {
        $judicial = $this->judicialRepository->create($judicialData);

        if(isEmpty($judicial))
            throw new \Exception('Judicial not created');

        return $judicial;
    }

    public function createJudicialWithDoc(array $judicial): Judicial
    {
        return $this->judicialRepository->createWithDoc($judicial);
    }

    /**
     * @throws \Exception
     */
    public function updateJudicial(JudicialData $judicialData, $id): Judicial
    {
        if(!$this->judicialRepository->find($id))
            throw new \Exception('Judicial not found');

        return $this->judicialRepository->update($judicialData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteJudicial($id): Judicial
    {
        $judicial = $this->judicialRepository->find($id);

        if(!$judicial)
            throw new \Exception('Judicial not found');

        return $judicial;
    }
}
