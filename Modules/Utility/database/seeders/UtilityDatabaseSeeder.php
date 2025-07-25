<?php

namespace Modules\Utility\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Utility\Models\Country;
use Modules\Utility\Models\District;
use Modules\Utility\Models\Province;
use Modules\Utility\Models\State;

class UtilityDatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->createCountry();
        $this->createState();

    }

    private function createCountry(): void
    {
        Country::firstOrCreate([
            'name'  =>  'PERÚ',
            'slug'  =>  Str::slug('PERÚ'),
            'ubigeo'=>  '000000'
        ]);
    }

    private function createState():void
    {
        $states = json_decode(file_get_contents(getcwd() . '/public/init/states.json'), true);
        $provinces = json_decode(file_get_contents(getcwd() . '/public/init/provinces.json'), true);
        $districts = json_decode(file_get_contents(getcwd() . '/public/init/districts.json'), true);

        $country = Country::where('ubigeo', '000000')->first();

        foreach ($states['states'] as $state) {
            $stateCreated = State::create([
                'name' => $state['departamento'],
                'slug' => Str::slug($state['departamento']),
                'ubigeo' => $state['reniec'],
                'country_id' => $country->id,
            ]);

            foreach ($provinces['provinces'] as $province) {

                if ($stateCreated['name'] == $province['departamento']) {
                    $provinceCreated = Province::create([
                        'name' => $province['provincia'],
                        'slug' => Str::slug($province['provincia']),
                        'ubigeo' => $province['reniec'],
                        'state_id' => $stateCreated->id,
                    ]);

                    foreach ($districts['districts'] as $district) {
                        if(array_key_exists('reniec' ,$district))
                        {
                            if ($stateCreated['name'] == $district['departamento'] && $provinceCreated['name'] == $district['provincia']) {
                                District::create([
                                    'name' => $district['distrito'],
                                    'slug' => Str::slug($district['distrito']),
                                    'ubigeo' => $district['reniec'],
                                    'province_id' => $provinceCreated->id,
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

}
