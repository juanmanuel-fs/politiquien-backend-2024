<?php

namespace Modules\Politician\services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\FiscalData;
use Modules\Politician\Models\Fiscal;
use Modules\Politician\Repositories\FiscalRepository;
use function PHPUnit\Framework\isEmpty;

class FiscalService
{
    public function __construct(
        protected FiscalRepository $fiscalRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function getFiscal($id): Fiscal
    {
        $fiscal = $this->fiscalRepository->find($id);

        if(!$fiscal)
            throw new \Exception('Fiscal not found');

        return $fiscal;
    }

    /**
     * @throws \Exception
     */
    public function getFiscals(): ?Collection
    {
        $fiscals = $this->fiscalRepository->all();

        if(isEmpty($fiscals))
            throw new \Exception('Fiscals not found');

        return $fiscals;
    }

    /**
     * @throws \Exception
     */
    public function createFiscal(FiscalData $fiscalData): Fiscal
    {
        $fiscal = $this->fiscalRepository->create($fiscalData);

        if(isEmpty($fiscal))
            throw new \Exception('Fiscals not created');

        return $fiscal;
    }

    public function createFiscalWithDoc(array $fiscal): Fiscal
    {
        return $this->fiscalRepository->createWithDoc($fiscal);
    }

    /**
     * @throws \Exception
     */
    public function updateFiscal(FiscalData $fiscalData, $id): Fiscal
    {
        if(!$this->fiscalRepository->find($id))
            throw new \Exception('Fiscals not found');

        return $this->fiscalRepository->update($fiscalData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteFiscal($id): Fiscal
    {
        $fiscal = $this->fiscalRepository->find($id);

        if(!$fiscal)
            throw new \Exception('Fiscals not found');

        return $fiscal;
    }

}
