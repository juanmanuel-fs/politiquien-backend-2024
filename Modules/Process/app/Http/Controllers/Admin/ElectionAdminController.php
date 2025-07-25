<?php

namespace Modules\Process\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Modules\Process\Http\Requests\Admin\StoreElectionRequest;
use Modules\Process\Http\Requests\Admin\UpdateElectionRequest;
use Modules\Process\Services\ElectionService;
use Modules\Process\Resource\Admin\ElectionSelectResource;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ElectionAdminController extends Controller
{
    public function __construct(
        protected ElectionService $electionService,
        protected HTTPResponse $httpResponse
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            return $this->httpResponse->ok(
                [
                    'data'  => $this->electionService->getElections(),
                    'links' => [
                        'self' => route('elections.index'),
                    ]
                ]
            );
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest(
                [
                    'errors' => $e->getMessage()
                ]
            );
        }
    }

    public function toSelect(Request $request): JsonResponse
    {
        try {
            $eclectionIds = explode(',', $request->query('ids'));
            $elections = $this->electionService->getForProcess($eclectionIds);
            return $this->httpResponse->ok(
                [
                    'data'  =>  ElectionSelectResource::collection($elections),
                    'links' =>  [
                        'self' => route('elections.admin.select'),
                    ]
                ]
            );
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest(
                [
                    'errors' => $e->getMessage()
                ]
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElectionRequest $request): JsonResponse
    {
        try {
            $election = $this->electionService->createElection($request->electionData);
            return $this->httpResponse->created([
                'data' => [
                    'type'      => 'elections',
                    'id'        => $election->id,
                ],
                'attributes'=> [
                    'name'      => $election->name,
                ],
                'relationships' => [
                    'positions' => $election->positions,
                ],
                'link' => [
                    'self'      => route('elections.show', $election->slug),
                    'related'   => route('elections.index'),
                ]
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            return $this->httpResponse->ok(
                [
                    'data' => $this->electionService->getElection($id)
                ]
            );
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest(
                [
                    'errors' => $e->getMessage()
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateElectionRequest $request, $id): JsonResponse
    {
        try {
            $election = $this->electionService->updateElection($request->electionData, $id);
            return $this->httpResponse->created(
                [
                    'data' =>
                        [
                            'type'      => 'election',
                            'id'        => $election->id,
                        ],
                    'attributes'=>
                        [
                            $election->getChanges()
                        ],
                    'link' =>
                        [
                            'self'      => route('elections.show', $election->slug),
                            'related'   => route('elections.index'),
                        ]
                ]
            );
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest(
                [
                    'errors' => $e->getMessage()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
       try{
           $election = $this->electionService->deleteElection($id);
           return $this->httpResponse->noContent(
               [
                   'data' =>
                       [
                           'type'       => 'election',
                       ],
                   'attributes'=>
                        [
                            'name'     => $election->name,
                        ]
               ]
           );
       }
       catch (\Exception $e){
           return $this->httpResponse->badRequest(
               [
                   'errors' => $e->getMessage()
               ]
           );
       }
    }
}
