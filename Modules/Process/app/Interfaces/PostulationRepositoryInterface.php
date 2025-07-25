<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\PostulationData;
use Modules\Process\Models\Postulation;

interface PostulationRepositoryInterface
{
    public function all(): ?Collection;
    public function find($id): ?Postulation;
    public function create(PostulationData $postulationData): ?Postulation ;
    public function update(PostulationData $postulationData, int $id): ?Postulation;
    public function delete(int $id): ?Postulation;
    public function logicalDelete(int $id): ?Postulation;
}
