<?php

namespace Modules\Politician\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\AdministrativeData;
use Modules\Politician\Models\Administrative;
use Modules\Politician\Repositories\AdministrativeRepository;
use function PHPUnit\Framework\isEmpty;

class AdministrativeService
{
    public function __construct(
        protected AdministrativeRepository $administrativeRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getAdministrative($id): Administrative
    {
        $administrative = $this->administrativeRepository->find($id);

        if(!$administrative)
            throw new \Exception('Administrative not found');

        return $administrative;
    }

    /**
     * @throws \Exception
     */
    public function getAdministratives(): ?Collection
    {
        $administratives = $this->administrativeRepository->all();

        if(isEmpty($administratives))
            throw new \Exception('Administratives not found');

        return $administratives;
    }

    /**
     * @throws \Exception
     */
    public function createAdministrative(AdministrativeData $administrativeData): Administrative
    {
        $administrative = $this->administrativeRepository->create($administrativeData);

        if(!$administrative)
            throw new \Exception('Administrative not created');

        return $administrative;
    }

    public function createAdministrativeWithDoc(array $administrative): Administrative
    {
        return $this->administrativeRepository->createWithDoc($administrative);
    }

    /**
     * @throws \Exception
     */
    public function updateAdministrative(AdministrativeData $administrativeData, $id): Administrative
    {
        if(!$this->administrativeRepository->find($id))
            throw new \Exception('Administrative not found');

        return $this->administrativeRepository->update($administrativeData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteAdministrative($id): Administrative
    {
        $administrative = $this->administrativeRepository->find($id);

        if(!$administrative)
            throw new \Exception('Administrative not found');

        return $administrative;
    }
}
