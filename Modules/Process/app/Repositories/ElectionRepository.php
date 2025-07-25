<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\ElectionData;
use Modules\Process\Interfaces\ElectionRepositoryInterface;
use Modules\Process\Models\Election;
use Illuminate\Support\Str;

class ElectionRepository implements ElectionRepositoryInterface
{
    public function all(): Collection
    {
        return Election::all();
    }

    public function find($id): Election | null
    {
        $election = Election::find($id);

        if(!$election){
            return null;
        }

        return $election;
    }

    public function allForProcess($ids): Collection
    {
        $elections = Election::whereIn('id', $ids)->get();
        return $elections;
    }

    public function existsSlug(string $slug, $id = null): bool
    {
        if ($id) {
            return Election::where('slug', Str::slug($slug))->where('id', '!=', $id)->exists();
        }

        return Election::where('slug', Str::slug($slug))->exists();
    }

    public function create(ElectionData $electionData): Election | null
    {
        $ids = [];

        foreach ($electionData->positions as $position) {
            $ids[] = $position->id;
        }

        $election = Election::create([
            'name'  => $electionData->name,
            'slug'  =>  Str::slug($electionData->name),
            'description'   => $electionData->description,
        ]);

        $election->positions()->syncWithoutDetaching($ids);

        return $election;
    }

    public function update(ElectionData $electionData, $id): Election | null
    {
        $election = $this->find($id);

        if (!$election)
        {
            return null;
        }

        $election->update([$electionData]);
        $election->touch();

        return $election;
    }

    public function delete($id): Election | null
    {
        $electionDelete = $this->find($id);

        $election = $electionDelete;

        if (!$electionDelete)
        {
            return null;
        }

        $electionDelete->delete();

        return $election;
    }
    public function logicalDelete($id): Election | null
    {
        $election = $this->find($id);

        $election->touch();
        $election->update(
            [
                'status'    => false,
                'deleted_at'=> now()
            ]
        );

        return $election;
    }
}
