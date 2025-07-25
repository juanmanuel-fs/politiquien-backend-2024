<?php

namespace Modules\Utility\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Utility\Data\ProvinceData;
use Modules\Utility\Models\Province;

class ProvinceRepository
{
    public function all(): ?Collection
    {
        return Province::all();
    }

    public function allForState($stateId): ?Collection
    {
        return Province::where('state_id', $stateId)->get();
    }

    public function find($id): ?Province
    {
        return Province::find($id);
    }

    public function findByUbigeo(string $ubigeo): ?Province
    {
        return Province::where('ubigeo', $ubigeo)->first();
    }

    public function create(ProvinceData $provinceData, int $stateId): ?Province
    {
        return Province::create([
            'name'      => $provinceData->name,
            'slug'      => Str::slug($provinceData->name),
            'ubigeo'    => $provinceData->ubigeo,
            'state_id'  => $stateId,
        ]);
    }

}
