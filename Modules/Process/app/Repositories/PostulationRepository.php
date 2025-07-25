<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PostulationData;
use Modules\Process\Interfaces\PostulationRepositoryInterface;
use Modules\Process\Models\Postulation;
use Illuminate\Support\Facades\Log;


class PostulationRepository implements PostulationRepositoryInterface
{
    public function all(): ?Collection
    {
        return Postulation::all();
    }

    public function find($id): ?Postulation
    {
        return Postulation::find($id);
    }

    public function findOrCreate(PostulationData $postulation, $electionableId, $processId, $organizationId): ?Postulation
    {
        $postulationRes = Postulation::where('electionable_id',$electionableId)->where('process_id', $processId)->where('organization_id', $organizationId)->first();

        $postulation = $postulationRes ?: Postulation::create([
            'status'            =>  true,
            'state'             =>  $postulation->state,
            'electionable_id'   =>  $electionableId,
            'organization_id'   =>  $organizationId,
            'process_id'        =>  $processId,
        ]);

        $postulation->processes()->syncWithoutDetaching($processId);

        return $postulation;
    }

    public function create(PostulationData $postulationData): ?Postulation
    {
        return Postulation::create($postulationData);
    }

    public function update(PostulationData $postulationData, $id): ?Postulation
    {
        $postulation = Postulation::find($id);
        if(!$postulation)
            return null;

        return $postulation->update([$postulationData]);
    }

    public function delete($id): ?Postulation
    {

        return null;
    }

    public function logicalDelete(int $id): ?Postulation
    {
        return null;
    }
}

