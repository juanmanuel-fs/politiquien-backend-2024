<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\DimensionData;
use Modules\Process\Models\Dimension;

interface DimensionRepositoryInterface
{
    public function all(): ?Collection;

    public function find($id): ?Dimension;

    public function create(DimensionData $dimensionData): Dimension;

    public function update(DimensionData $dimensionData, $id): Dimension;

    public function delete($id): Dimension;
}
