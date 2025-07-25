<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Process\Data\PositionData;
use Modules\Process\Interfaces\PositionRepositoryInterface;
use Modules\Process\Models\Position;

class PositionRepository implements PositionRepositoryInterface
{
    public function all(): Collection
    {
        return Position::all();
    }

    public function find($id): ?Position
    {
        $position = Position::find($id);

        if(!$position) {
            return null;
        }

        return $position;
    }

    public function findByName($name): ?Position
    {
        return Position::where('name', $name)->first();
    }

    public function existsSlug(string $slug, $id = null): bool
    {
        if ($id) {
            return Position::where('slug', Str::slug($slug))->where('id', '!=', $id)->exists();
        }

        return Position::where('slug', Str::slug($slug))->exists();
    }

    public function create(PositionData $positionData): Position | null
    {
        return $election = Position::create([
            'name'  => $positionData->name,
            'slug'  =>  Str::slug($positionData->name),
            'description'   => $positionData->description,
        ]);
    }

    public function update(PositionData $positionData, $id): Position | null
    {
        $position = $this->find($id);

        if (!$position)
        {
            return null;
        }

        $position->update([$positionData]);
        $position->touch();

        return $position;
    }

    public function delete($id): Position | null
    {
        $positionDelete = $this->find($id);

        $position = $positionDelete;

        if (!$positionDelete)
        {
            return null;
        }

        $positionDelete->delete();

        return $position;
    }
    public function logicalDelete($id): Position | null
    {
        $position = $this->find($id);

        $position->touch();
        $position->update(
            [
                'status'    => false,
                'deleted_at'=> now()
            ]
        );

        return $position;
    }
}

