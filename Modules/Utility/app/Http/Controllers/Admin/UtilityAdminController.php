<?php

namespace Modules\Utility\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Utility\Services\StateService;
use Modules\Utility\Resource\Admin\StateSelectResource;
use Modules\Utility\Services\ProvinceService;

class UtilityAdminController extends Controller
{
    
    public function __construct(
        protected StateService $stateService,
        protected ProvinceService $provinceService,
        protected HTTPResponse $httpResponse
    ){}


    public function index()
    {
        $parentDirectory = dirname(getcwd()).'/Modules/Utility/database/init/province';
        return $parentDirectory;
    }

    public function statesSelect()
    {
        try {
            $states = $this->stateService->getStates();

            return $this->httpResponse->ok([
                'data'  =>  StateSelectResource::collection($states),
                'link'  =>  route('utilities.admin.states.select')
            ]);
        } catch (\Exception $e) {
            return $this->httpResponse->badRequest([
                'errors'    => $e->getMessage(),
            ]);
        }
    }

    public function provincesSelect($id)
    {
        try {
            $province = $this->provinceService->getForState($id);

            return $this->httpResponse->ok([
                'data'  =>  StateSelectResource::collection($province),
                'link'  =>  route('utilities.admin.provinces.select', $id)
            ]);
        } catch (\Exception $e) {
            return $this->httpResponse->badRequest([
                'errors'    => $e->getMessage(),
            ]);
        }
    }
}
