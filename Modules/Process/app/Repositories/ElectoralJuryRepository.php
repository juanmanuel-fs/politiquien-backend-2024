<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectoralJuryData;
use Modules\Process\Interfaces\ElectoralJuryRepositoryInterface;
use Modules\Process\Models\ElectoralJury;

class ElectoralJuryRepository implements ElectoralJuryRepositoryInterface
{
    public function all(): Collection
    {
        return ElectoralJury::all();
    }

    public function find($id): ?ElectoralJury
    {
        return ElectoralJury::find($id);
    }

    public function create(ElectoralJuryData $electoralJuryData): ElectoralJury
    {
        return ElectoralJury::create($electoralJuryData);
    }

    public function update(ElectoralJuryData $electoralJuryData, $id): ElectoralJury
    {
        $electoralJury = ElectoralJury::find($id);
        $electoralJury->update($electoralJuryData);
        $electoralJury->touch();

        return $electoralJury;
    }

    public function delete($id): bool
    {
        return ElectoralJury::destroy($id);
    }

}

