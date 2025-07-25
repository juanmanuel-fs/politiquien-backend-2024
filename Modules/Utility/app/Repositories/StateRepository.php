<?php

namespace Modules\Utility\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Utility\Data\StateData;
use Modules\Utility\Models\State;

class StateRepository
{
    public function all(): ?Collection
    {
        return State::all();
    }

    public function find($id): ?State
    {
        return State::find($id);
    }

    public function findByUbigeo(string $ubigeo): ?State
    {
        return State::where('ubigeo', $ubigeo)->first();
    }

    public function create(StateData $stateData, int $countryId): ?State
    {
        return State::create([
            'name'      =>  $stateData->name,
            'slug'      => Str::slug($stateData->name),
            'ubigeo'    =>  $stateData->ubigeo,
            'country_id'=>  $countryId,
        ]);
    }
}
