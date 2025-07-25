<?php

namespace Modules\Process\Interfaces;

use Modules\Process\Models\Process;
use Modules\Process\Data\ProcessData;
use \Illuminate\Database\Eloquent\Collection;


interface ProcessRepositoryInterfaces
{
    public function all(): Collection;
    public function query(array $query): Collection;
    public function find(string $slug): ?Process;
    public function existsSlug(string $slug, $id = null): bool;
    public function current(): ?Process;
    public function create(ProcessData $processData): ?Process ;
    public function update(ProcessData $processData, int $id): ?Process;
    public function delete(int $id): ?Process;
    public function logicalDelete(int $id): ?Process;
}
