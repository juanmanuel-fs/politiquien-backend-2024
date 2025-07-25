<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\CandidateData;
use Modules\Process\Models\Candidate;
use Illuminate\Pagination\LengthAwarePaginator;

interface CandidateRepositoryInterface
{
    public function all(): ?Collection ;
    public function allActive($pagination): LengthAwarePaginator ;
    public function allByProcess($processId): ?Collection;
    public function find($id): ?Candidate;
    public function create(CandidateData $candidateData, int  $postulationId, int $positionId): ?Candidate;
    public function update(CandidateData $candidateData, $id): ?Candidate;

}
