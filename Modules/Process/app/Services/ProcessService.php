<?php

namespace Modules\Process\Services;

use Modules\Process\Data\ProcessData;
use Modules\Process\Models\Process;
use Modules\Process\Repositories\ProcessRepository;
use Illuminate\Database\Eloquent\Collection;


class ProcessService
{
    public function __construct(
        protected ProcessRepository $processRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getProcess($slug): Process
    {
        $process = $this->processRepository->find($slug);

        if(!$process){
            throw new \Exception('No existe proceso');
        }

        return $this->processRepository->find($slug);
    }

    /**
     * @throws \Exception
     */
    public function getCurrentProcess(): Process
    {
        $currentProcess = $this->processRepository->query(['is_current', true])->first();
        if(!$currentProcess){
            throw new \Exception('No hay un proceso activo');
        }
        return $currentProcess;
    }

    public function getProcesses(): Collection
    {
        return $this->processRepository->all();
    }

    /**
     * @throws \Exception
     */
    public function createProcess(ProcessData $process): Process
    {
        if($this->processRepository->existsSlug($process->title))
        {
            throw new \Exception('El título ya existe !!!');
        }

        return $this->processRepository->create($process);
    }

    /**
     * @throws \Exception
     */
    public function updateProcess(ProcessData $process, $id): Process
    {
        if($this->processRepository->existsSlug($process->title, $id))
        {
            throw new \Exception('El titulo ya existe!!!');
        }

        $process = $this->processRepository->update($process, $id);

        if($process ==  null)
        {
            throw new \Exception('El proceso no existe!!!');
        }

        return $process;
    }

    public function deleteProcess($id): Process
    {
        return $this->processRepository->delete($id);
    }

}
