<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionableData;
use Modules\Process\Models\Electionable;

interface ElectionableRepositoryInterface
{
    public function all(): Collection;
    public function find($id): ?Electionable;
    public function create(ElectionableData $electionableData): ?Electionable;
    public function update(ElectionableData $electionableData, $id): Electionable;
    public function delete($id):bool;

}
