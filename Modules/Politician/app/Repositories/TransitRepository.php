<?php

namespace Modules\Politician\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\TransitData;
use Modules\Politician\Models\Transit;

class TransitRepository
{
    public function all(): Collection
    {
        return Transit::all();
    }

    public function find($id): ?Transit
    {
        return Transit::find($id);
    }

    public function create(TransitData $transitData): Transit
    {
        return Transit::create([
            'registration'  => $transitData->registration,
            'misconduct'    => $transitData->misconduct,
            'description'   => $transitData->description,
            'comment'       => $transitData->comment,
            'candidate_id'  => $transitData->candidateId,
        ]);
    }

    public function update(TransitData $transitData, $id): ?Transit
    {
        $administrative = Transit::find($id)->update([
            'registration'  => $transitData->registration,
            'misconduct'    => $transitData->misconduct,
            'description'   => $transitData->description,
            'comment'       => $transitData->comment,
            'candidate_id'  => $transitData->candidateId,
        ]);

        $administrative->touch();

        return $administrative;
    }

    public function delete($id): bool
    {
        return Transit::destroy($id);
    }

    public function createWithDoc(array $data): Transit
    {
        $candidate = null;

        if(strlen($data[0]) < 8)
        {
            $candidate = Transit::where('dni','0'.$data[0])->first();
        }
        else
        {
            $candidate = Transit::where('dni',$data[0])->first();
        }

        return Transit::create([
            'sanction'      =>  $data[0],
            'misconduct'    =>  trim($data[4]),
            'comment'       =>  trim($data[5]),
            'politician_id' =>  $candidate->id ?? null,
        ]);
    }


}
