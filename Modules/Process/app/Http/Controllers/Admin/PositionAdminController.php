<?php

namespace Modules\Process\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\Request;
use Modules\Process\Http\Requests\Admin\StorePositionRequest;
use Modules\Process\Services\PositionService;

class PositionAdminController extends Controller
{
    public function __construct(
        protected PositionService $positionService,
        protected HTTPResponse $httpResponse,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return $this->httpResponse->ok(
                [
                    'data'  => $this->positionService->getPositions(),
                    'links' => [
                        "self"  => route('positions.index'),
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
    public function store(StorePositionRequest $request)
    {
        try {
            $election = $this->positionService->createPosition($request->positionData);
            return $this->httpResponse->created([
                'data' => [
                    'type'      => 'elections',
                    'id'        => $election->id,
                ],
                'attributes'=> [
                    'name'      => $election->name,
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
    public function show($id)
    {
        try {
            return $this->httpResponse->ok(
                [
                    'data' => $this->positionService->getPosition($id)
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
    public function update(Request $request, $id)
    {
        try {
            $election = $this->positionService->updatePosition($request->electionData, $id);
            return $this->httpResponse->created([
                'data' => [
                    'type'      => 'election',
                    'id'        => $election->id,
                ],
                'attributes'=> $election->getChanges(),
                'link' => [
                    'self'      => route('elections.show', $election->slug),
                    'related'   => route('elections.index'),
                ]
            ]);
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
    public function destroy($id)
    {
        try{
            $election = $this->positionService->deletePosition($id);
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
