<?php

namespace Modules\Politician\Repositories;
use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\AdministrativeData;
use Modules\Politician\Models\Administrative;
use Modules\Process\Models\Candidate;

class AdministrativeRepository
{
    public function all(): Collection
    {
        return Administrative::all();
    }

    public function find($id): ?Administrative
    {
        return Administrative::find($id);
    }

    public function create(AdministrativeData $administrativeData): ?Administrative
    {
        return Administrative::create([
            'sanction'      =>  $administrativeData->sanction,
            'misconduct'    =>  $administrativeData->misconduct,
            'comment'       =>  $administrativeData->comment,
            'candidate_id'  =>  $administrativeData->candidateId,
        ]);
    }

    public function update(AdministrativeData $administrativeData, $id): ?Administrative
    {
        $administrative = Administrative::find($id)->update([
            'sanction'      => $administrativeData->sanction,
            'misconduct'    => $administrativeData->misconduct,
            'comment'       => $administrativeData->comment,
            'candidate_id'  => $administrativeData->candidateId
        ]);

        $administrative->touch();

        return $administrative;
    }

    public function delete($id): bool
    {
        return Administrative::destroy($id);
    }

    public function createWithDoc(array $data): Administrative
    {
        $candidate = null;

        if(strlen($data[0]) < 8)
        {
            $candidate = Candidate::where('dni','0'.$data[0])->first();
        }
        else
        {
            $candidate = Candidate::where('dni',$data[0])->first();
        }

        return Administrative::create([
            'sanction'      =>  $data[0],
            'misconduct'    =>  trim($data[4]),
            'comment'       =>  trim($data[5]),
            'politician_id' =>  $candidate->id ?? null,
        ]);
    }

}
