<?php

namespace Modules\Process\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Process\Models\Election;
use Modules\Process\Models\Organization;
use Modules\Process\Models\Position;
use Modules\Process\Models\Process;
use Modules\Utility\Models\Country;
use Modules\Utility\Models\District;
use Modules\Utility\Models\Province;
use Modules\Utility\Models\State;

class ProcessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->organization();
        $this->position();
        $this->election();
        $this->electionable();
        $this->process();
    }
    private function organization():void
    {
        $organizations = json_decode(file_get_contents(getcwd() . '/public/init/organizations-113.json'), true);

        foreach ($organizations['organizations'] as $organization) {
            Organization::create([
                'name'  =>  $organization['strOrganizacionPolitica'],
                'slug'  =>  Str::slug($organization['strOrganizacionPolitica'].' '.($organization['strUsuario'] ?? '')),
                'jne_id'=>  $organization['idOrganizacionPolitica'],
                'type'  =>  match($organization['strTipoOrganizacion']){
                    'PARTIDOS POLITICOS' => 1,
                    'MOVIMIENTOS REGIONALES O DEPARTAMENTALES' => 2,
                    'ALIANZAS ELECTORALES' => 3,
                    default => 4
                }
            ]);
        }
    }

    private function position():void
    {
        $positions = json_decode(file_get_contents(getcwd() . '/public/init/positions.json'), true);
        foreach ($positions['positions'] as $position) {
            Position::create([
                'name'  =>  $position['name'],
                'slug'  =>  Str::slug($position['name']),
                'binary_name'   =>  $position['binaryName'],
                'jne_id'=>  $position['jneId'],
            ]);
        }
    }

    private function election():void
    {
        $elections = json_decode(file_get_contents(getcwd() . '/public/init/elections.json'), true);
        foreach ($elections['elections'] as $election) {
            $electionCreated = Election::create([
                'name'  =>  $election['name'],
                'slug'  =>  Str::slug($election['name']),
                'jne_id'=>  $election['jneId'],
            ]);
            $electionCreated->positions()->sync($election['positions']);
        }
    }

    private function electionable()
    {
        $country =  Country::where('slug', 'peru')->first();
        $country->elections()->sync([1,3]);

        $states = State::all();
        foreach($states as $state)
        {
            $state->elections()->sync([2,4]);
        }

        $provinces = Province::all();
        foreach($provinces as $province)
        {
            $province->elections()->sync([5]);
        }

        $districts = District::all();
        foreach($districts as $district)
        {
            $district->elections()->sync([6]);
        }
    }

    private function process()
    {
        $processes = json_decode(file_get_contents(getcwd() . '/public/init/processes.json'), true);
        foreach ($processes['processes'] as $process) {
            $processCreate = [
                'jne_id'    =>  $process['idProcesoElectoral'],
                'title'     =>  $process['strProcesoElectoral'],
                'slug'      =>  Str::slug($process['strProcesoElectoral']),
                'date'      =>  $process['strFechaAperturaProceso'],
                'is_current'=>  false,
                'status'    =>  true,
            ];
            if ($process['strSegundaVuelta']) {
                $lastProcess = Process::latest()->first();
                $processCreate['process_id'] = $lastProcess->id;
            }
            if ($process['idProcesoElectoral'] == 84) {
                $processCreate['is_current'] = true;
            }

            $afterProcessCreate = Process::create($processCreate);
            $afterProcessCreate->elections()->sync($process['idElecciones']);
        }
    }
}
