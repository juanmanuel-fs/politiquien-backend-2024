<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\DimensionData;
use Modules\Process\Interfaces\DimensionRepositoryInterface;
use Modules\Process\Models\Dimension;

class DimensionRepository implements DimensionRepositoryInterface
{
    public function all(): ?Collection
    {
        return Dimension::all();
    }

    public function find($id): ?Dimension
    {
        return Dimension::find($id);
    }
    public function create(DimensionData $dimensionData): Dimension
    {
        return Dimension::create($dimensionData);
    }

    public function update(DimensionData $dimensionData, $id): Dimension
    {
        $dimension = Dimension::find($id);
        $dimension->update($dimensionData);
        $dimension->touch();

        return $dimension;
    }

    public function delete($id): Dimension
    {
        $dimensionDelete = Dimension::find($id);
        $dimension = $dimensionDelete;
        $dimensionDelete->delete();

        return $dimension;
    }
}
