<?php

namespace Modules\Utility\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Utility\Models\Province;
use Modules\Utility\Repositories\ProvinceRepository;

class ProvinceService
{
    public function __construct(
        protected ProvinceRepository $provinceRepository
    ){}


    /**
     * @throws \Exception
     */
    public function getProvince($id): Province
    {
        $state = $this->provinceRepository->find($id);
        if(!$state){
            throw new \Exception('La state no existe');
        }
        return $state;
    }

     /**
     * @throws \Exception
     */
    public function getForState($stateId): Collection
    {
        $province = $this->provinceRepository->allForState($stateId);
        if(!$province){
            throw new \Exception('La province no existe');
        }
        return $province;
    }

}
