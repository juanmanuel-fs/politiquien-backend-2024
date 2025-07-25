<?php

namespace Modules\Utility\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Utility\Data\DistrictData;
use Modules\Utility\Models\District;

class DistrictRepository
{
    public function all(): ?Collection
    {
        return District::all();
    }

    public function find($id): ?District
    {
        return District::find($id);
    }

    public function findByUbigeo(string $ubigeo): ?District
    {
        return District::where('ubigeo', $ubigeo)->first();
    }

    public function create(DistrictData $districtData, int $provinceId): ?District
    {
        return District::create([
            'name'          => $districtData->name,
            'slug'          => Str::slug($districtData->name),
            'ubigeo'        => $districtData->ubigeo,
            'province_id'   => $provinceId,
        ]);
    }
}
