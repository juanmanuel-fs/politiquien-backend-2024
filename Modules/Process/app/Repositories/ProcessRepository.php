<?php

namespace Modules\Process\Repositories;

use Modules\Process\Data\ProcessData;
use Modules\Process\Interfaces\ProcessRepositoryInterfaces;
use Modules\Process\Models\Process;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProcessRepository implements ProcessRepositoryInterfaces
{
    public function all(): Collection
    {
        return Process::with([
            'elections' => function ($query) {
                $query->select('elections.id', 'elections.name'); 
            }, 
            'postulations' => function ($query) {
                $query->select('postulations.organization_id'); 
        }])->get();
    }

    public function find(string $slug): Process | null
    {
        return Process::where('slug' ,$slug)->first();
    }

    public function existsSlug(string $slug, $id = null): bool
    {
        if ($id) {
            return Process::where('slug', Str::slug($slug))->where('id', '!=', $id)->exists();
        }

        return Process::where('slug', Str::slug($slug))->exists();
    }

    public function create(ProcessData $processData): Process
    {
        $ids = [];

        foreach ($processData->elections as $election) {
            $ids[] = $election->id;
        }

        $process = Process::create(
            [
                'title'         => $processData->title,
                'slug'          => Str::slug($processData->title),
                'subtitle'      => $processData->subtitle,
                'slogan'        => $processData->slogan,
                'description'   => $processData->description,
                'date'          => $processData->date,
                'status'        => $processData->status,
                'is_current'    => $processData->isCurrent,
            ]
        );

        $process->elections()->syncWithoutDetaching($ids);

        return $process;
    }

    public function update(ProcessData $processData, int $id): Process | null
    {
        $process = $this->find($id);
        if (!$process) {
            return null;
        }

        $process->update(
            [
                'title'         => $processData->title,
                'slug'          => Str::slug($processData->title),
                'subtitle'      => $processData->subtitle,
                'slogan'        => $processData->slogan,
                'description'   => $processData->description,
                'date'          => $processData->date,
                'status'        => $processData->status,
                'is_current'    => $processData->isCurrent,
            ]
        );
        $process->touch();
        return $process;
    }

    public function current(): ?Process
    {
        return Process::where('is_current', true)->first();
    }
    public function query(array $query): Collection
    {
        return Process::where($query[0], $query[1])->get();
    }

    public function delete(int $id): Process | null
    {
        $processDelete = $this->find($id);

        $process = $processDelete;

        if (!$processDelete)
        {
            return null;
        }

        $processDelete->delete();

        return $process;
    }

    public function logicalDelete(int $id): Process | null
    {
        $process = $this->find($id);
        $process->update([
            'status'    => false,
            'deleted_at'=> now(),
        ]);
        $process->touch();
        return $process;
    }
}
