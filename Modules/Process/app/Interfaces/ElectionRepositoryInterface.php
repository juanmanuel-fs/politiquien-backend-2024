<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionData;
use Modules\Process\Models\Election;

interface ElectionRepositoryInterface
{
    public function all(): Collection;
    public function find($id): Election | null;
    public function allForProcess(array $ids): Collection;
    public function create(ElectionData $electionData): Election | null;
    public function update(ElectionData $electionData, $id): Election | null;
    public function existsSlug(string $slug, $id = null): bool;
    public function delete($id): Election | null;
    public function logicalDelete($id): Election | null;
}
