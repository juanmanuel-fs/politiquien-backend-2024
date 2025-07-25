<?php

namespace Modules\Process\Services;

use Modules\Process\Models\Postulation;
use Modules\Process\Repositories\PostulationRepository;

class PostulationService
{
    public function __construct(
        protected PostulationRepository $postulationRepository
    ){}


    /**
     * @throws \Exception
     */
    public function getPostulation($id): Postulation
    {
        $postulation = $this->postulationRepository->find($id);
        if(!$postulation){
            throw new \Exception('La postulación no existe');
        }
        return $postulation;
    }

    /**
     * @throws \Exception
     */
    public function createPostulation($data): Postulation
    {
        $postulation = $this->postulationRepository->create($data);
        if(!$postulation){
            throw new \Exception('Error al crear la postulación');
        }
        return $postulation;
    }

}
