<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PositionData;
use Modules\Process\Models\Position;

interface PositionRepositoryInterface
{
    public function all(): Collection;
    public function find($id): Position | null;
    public function create(PositionData $positionData): Position | null;
    public function update(PositionData $positionData, $id): Position | null;
    public function existsSlug(string $slug, $id = null): bool;
    public function delete($id): Position | null;
    public function logicalDelete($id): Position | null;

}
