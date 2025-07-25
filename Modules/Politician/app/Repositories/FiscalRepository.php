<?php

namespace Modules\Politician\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\FiscalData;
use Modules\Politician\Models\Fiscal;

class FiscalRepository
{
    public function all(): Collection
    {
        return Fiscal::all();
    }

    public function find($id): ?Fiscal
    {
        return Fiscal::find($id);
    }

    public function create(FiscalData $fiscalData): Fiscal
    {
        return Fiscal::create([
            'complaint'     => $fiscalData->complaint,
            'state'         => $fiscalData->state,
            'crime'         => $fiscalData->crime,
            'description'   => $fiscalData->description,
            'comment'       => $fiscalData->comment,
            'candidate_id'  => $fiscalData->candidateId
        ]);
    }

    public function update(FiscalData $fiscalData, $id): ?Fiscal
    {
        $administrative = Fiscal::find($id)->update([
            'complaint'     => $fiscalData->complaint,
            'state'         => $fiscalData->state,
            'crime'         => $fiscalData->crime,
            'description'   => $fiscalData->description,
            'comment'       => $fiscalData->comment,
            'candidate_id'  => $fiscalData->candidateId
        ]);

        $administrative->touch();

        return $administrative;
    }

    public function delete($id): bool
    {
        return Fiscal::destroy($id);
    }

    public function createWithDoc(array $data): Fiscal
    {
        $candidate = null;

        if(strlen($data[0]) < 8)
        {
            $candidate = Fiscal::where('dni','0'.$data[0])->first();
        }
        else
        {
            $candidate = Fiscal::where('dni',$data[0])->first();
        }

        return Fiscal::create([
            'sanction'      =>  $data[0],
            'misconduct'    =>  trim($data[4]),
            'comment'       =>  trim($data[5]),
            'politician_id' =>  $candidate->id ?? null,
        ]);
    }
}
