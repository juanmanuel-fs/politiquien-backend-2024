<?php

namespace Modules\Politician\services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\TransitData;
use Modules\Politician\Models\Transit;
use Modules\Politician\Repositories\TransitRepository;
use function PHPUnit\Framework\isEmpty;

class TransitService
{

    public function __construct(
        protected TransitRepository $transitRepository,
    ){}

    /**
     * @throws \Exception
     */
    public function getTransit($id): Transit
    {
        $transit = $this->transitRepository->find($id);

        if(!$transit)
            throw new \Exception('Transit not found');

        return $transit;
    }

    /**
     * @throws \Exception
     */
    public function getTransits(): Collection
    {
        $transit = $this->transitRepository->all();

        if(isEmpty($transit))
            throw new \Exception('Transits not found');

        return $transit;
    }

    /**
     * @throws \Exception
     */
    public function createTransit(TransitData $transitData): Transit
    {
        $transit = $this->transitRepository->create($transitData);

        if(isEmpty($transit))
            throw new \Exception('Transit not created');

        return $transit;
    }

    public function createTransitWithDoc(array $fiscal): Transit
    {
        return $this->transitRepository->createWithDoc($fiscal);
    }

    /**
     * @throws \Exception
     */
    public function updateTransit(TransitData $transitData, $id): Transit
    {
        if(!$this->transitRepository->find($id))
            throw new \Exception('Transit not found');

        return $this->transitRepository->update($transitData, $id);
    }

    /**
     * @throws \Exception
     */
    public function deleteTransit($id): Transit
    {
        $transit = $this->transitRepository->find($id);

        if(!$transit)
            throw new \Exception('Transit not found');

        return $transit;
    }

}
