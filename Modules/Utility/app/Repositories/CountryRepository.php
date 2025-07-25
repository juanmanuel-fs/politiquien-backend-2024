<?php

namespace Modules\Utility\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Utility\Data\CountryData;
use Modules\Utility\Models\Country;

class CountryRepository
{

    public function all(): ?Collection
    {
        return Country::all();
    }

    public function find($id): ?Country
    {
        return Country::find($id);
    }

    public function findByUbigeo(string $ubigeo): ?Country
    {
        return Country::where('ubigeo', $ubigeo)->first();
    }

    public function findByName(string $name): ?Country
    {
        return Country::where('name', $name)->first();
    }

    public function create(CountryData $countryData): ?Country
    {
        return Country::create([
            'name'      => $countryData->name,
            'slug'      => Str::slug($countryData->name),
            'ubigeo'    => $countryData->ubigeo,
        ]);
    }
}
