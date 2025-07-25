<?php

namespace Modules\Politician\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\JudicialData;
use Modules\Politician\Models\Judicial;

class JudicialRepository
{

    public function all(): Collection
    {
        return Judicial::all();
    }

    public function find($id): ?Judicial
    {
        return Judicial::find($id);
    }

    public function create(JudicialData $judicialData): Judicial
    {
        return Judicial::create([
            'background'    => $judicialData->background,
            'state'         => $judicialData->state,
            'crime'         => $judicialData->crime,
            'comment'       => $judicialData->comment,
            'description'   => $judicialData->description,
            'candidate_id'  => $judicialData->candidateId,
        ]);
    }

    public function update(JudicialData $judicialData, $id): ?Judicial
    {
        $administrative = Judicial::find($id)->update([
            'background'    => $judicialData->background,
            'state'         => $judicialData->state,
            'crime'         => $judicialData->crime,
            'comment'       => $judicialData->comment,
            'description'   => $judicialData->description,
            'candidate_id'  => $judicialData->candidateId,
        ]);

        $administrative->touch();

        return $administrative;
    }

    public function delete($id): bool
    {
        return Judicial::destroy($id);
    }

    public function createWithDoc(array $data): Judicial
    {
        $candidate = null;

        if(strlen($data[0]) < 8)
        {
            $candidate = Judicial::where('dni','0'.$data[0])->first();
        }
        else
        {
            $candidate = Judicial::where('dni',$data[0])->first();
        }

        return Judicial::create([
            'sanction'      =>  $data[0],
            'misconduct'    =>  trim($data[4]),
            'comment'       =>  trim($data[5]),
            'politician_id' =>  $candidate->id ?? null,
        ]);
    }
}
