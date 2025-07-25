<?php

namespace Modules\Process\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Process\Services\OrganizationService;
use Modules\Process\Resource\Admin\OrganizationSelectResource;

class OrganizationAdminController extends Controller
{

    public function __construct(
        protected OrganizationService $organizationService,
        protected HTTPResponse $httpResponse,
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json([]);
    }

    public function toSelect(): JsonResponse
    {
        try {
            $organizations = $this->organizationService->getOrganizations();
            return $this->httpResponse->ok([
                'data'  =>  OrganizationSelectResource::collection($organizations),
                'links' =>  route('organizations.admin.select')
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function toSelectFromProcess(Request $request): JsonResponse
    {
        try {
            $organizationIds = explode(',', $request->query('ids'));
            $organizations = $this->organizationService->getFromProcess($organizationIds);
            return $this->httpResponse->ok([
                'data'  =>  OrganizationSelectResource::collection($organizations),
                'links' =>  route('organizations.admin.select_from_process')
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
