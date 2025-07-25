<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectoralJuryData;
use Modules\Process\Models\ElectoralJury;

interface ElectoralJuryRepositoryInterface
{
    public function all(): Collection;
    public function find($id): ?ElectoralJury;
    public function create(ElectoralJuryData $electoralJuryData): ?ElectoralJury;
    public function update(ElectoralJuryData $electoralJuryData, $id): ?ElectoralJury;
    public function delete($id): bool;
}
