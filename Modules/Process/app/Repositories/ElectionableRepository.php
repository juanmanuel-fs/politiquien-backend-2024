<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionableData;
use Modules\Process\Interfaces\ElectionableRepositoryInterface;
use Modules\Process\Models\Electionable;

class ElectionableRepository implements ElectionableRepositoryInterface
{
    public function all(): Collection
    {
        return Electionable::all();
    }

    public function find($id):  ?Electionable
    {
        return Electionable::find($id);
    }

    public function findObjectModel($model, $id): ?Electionable
    {
        return Electionable::where('electionable_type', $model)->where('electionable_id', $id)->first();
    }

    public function create(ElectionableData $electionableData): ?Electionable
    {
        return Electionable::create($electionableData);
    }

    public function update(ElectionableData $electionableData, $id): Electionable
    {
        $electionable = Electionable::find($id);
        $electionable->update($electionableData);
        $electionable->update();

        return $electionable;
    }

    public function delete($id): bool
    {
        return Electionable::destroy($id);
    }
}
