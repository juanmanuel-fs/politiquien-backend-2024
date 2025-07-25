<?php

namespace Modules\Utility\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Utility\Models\State;
use Modules\Utility\Repositories\StateRepository;

class StateService
{
    public function __construct(
        protected StateRepository $stateRepository
    ){}


    /**
     * @throws \Exception
     */
    public function getState($id): State
    {
        $state = $this->stateRepository->find($id);
        if(!$state){
            throw new \Exception('La state no existe');
        }
        return $state;
    }

     /**
     * @throws \Exception
     */
    public function getStates(): Collection
    {
        $states = $this->stateRepository->all();
        if(!$states){
            throw new \Exception('La states no existe');
        }
        return $states;
    }

}
