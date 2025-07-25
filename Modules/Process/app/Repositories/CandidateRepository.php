<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Process\Data\CandidateData;
use Modules\Process\Interfaces\CandidateRepositoryInterface;
use Modules\Process\Models\Candidate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Process\Models\Process;
use Modules\Utility\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;


class CandidateRepository implements CandidateRepositoryInterface
{
    public function find($id): ?Candidate
    {
        return Candidate::find($id);
    }

    public function all(): ?Collection
    {
        return Candidate::all();
    }

    public function allActive($pagination = 12): LengthAwarePaginator
    {
        return Candidate::where('status', true)->paginate($pagination);
    }

    public function allByProcess($processId): ?Collection
    {
        return Candidate::where('process_id', $processId)->last();
    }

    private function slug($name): string
    {
        $slug = Str::slug($name);
        return Candidate::where('slug', $slug)->get();
    }

    public function create(CandidateData $candidateData, $postulationId, $positionId): ?Candidate
    {
        $slug = Str::slug($candidateData->fullName.' '.$candidateData->dni.' '.$candidateData->processId);

        Log::error("⚠️ Error detectado: " . $positionId);

        return Candidate::create([
            'jne_id'        => $candidateData->jneId,
            'full_name'     => $candidateData->fullName,
            'image'         => $candidateData->imageUrl,
            'slug'          => $slug,
            'dni'           => $candidateData->dni,
            'keywords'      => $candidateData->fullName,
            'state'         => $candidateData->postulation->state,
            'status'        => true,
            'number'        => $candidateData->postulation->number,
            'process_id'    => $candidateData->processId,
            'position_id'   => $positionId,
            'postulation_id'=> $postulationId
        ]);
    }

    public function update($candidateData, $id): ?Candidate
    {
        $candidateUpdate = $candidateData;

       /* $processId = (new PostulationRepository)->find($candidateUpdate->postulationId)->process->id;
        $candidateUpdate['slug'] = Str::slug($candidateUpdate->name.' '.$candidateUpdate->dni.' '.$processId);*/

        $candidate = $this->find($id);
        $candidate->update([$candidateUpdate]);
        $candidate->touch();

        return $candidate;
    }

    public function updateState($id, $state): ?Candidate
    {
        $candidate = $this->find($id);
        $candidate->update([$state]);
        $candidate->touch();

        return $candidate;
    }

    private function gener()
    {

    }

    // Scope Candidate model

    public function scopeProcess(Builder $query, $processId): ?Builder
    {
        if ($processId)
            return $query->where('process_id', $processId);

        return null;
    }

    public function scopeState(Builder $query, $stateId): ?Builder
    {
        if ($stateId)
            return $query->where('state', $stateId);

        return null;
    }

    public function scopeNameDni(Builder $query, $name): ?Builder
    {
        if ($name)
            return $query->where(DB::raw('CONCAT(name," ",dni)'), 'LIKE', '%' . $name . '%');

        return null;
    }

    public function scopeOrganization($query, $organizationId): ?Builder
    {
        if($organizationId)
            return $query->whereHas('organization', function($q) use($organizationId){
                $q->where('organization_id', $organizationId);
            });
        return null;
    }

    public function scopeProvince($query, $provinceId): ?Builder
    {
        if($provinceId)
            return $query->whereHas('postulation.electionable', function($q) use($provinceId){
                $q->where('electionable_id', $provinceId)->where('electionable_type','App\\Models\\Province');
            });

        return null;
    }

    public function scopeDistrict($query, $districtId): ?Builder
    {
        if($districtId)
            return $query->whereHas('postulation.electionable', function($q) use($districtId){
                $q->where('electionable_id', $districtId)->where('electionable_type','App\\Models\\District');
            });

        return null;
    }

    public function scopeElection($query, $electionId): ?Builder
    {
        if($electionId)
            return $query->whereHas('electionable', function($q) use($electionId){
                $q->where('election_id',$electionId);
            });

        return null;
    }

    public function scopePosition($query, $positionIds): ?Builder
    {
        if($positionIds)
            $ids = explode(',', $positionIds);
            return $query->whereHas('position', function($q) use($ids){
                $q->whereIn('id',$ids);
            });
    }

}
