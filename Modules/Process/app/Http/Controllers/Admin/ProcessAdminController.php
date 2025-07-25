<?php

namespace Modules\Process\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\JsonResponse;

use Modules\Process\Http\Requests\Admin\StoreProcessRequest;
use Modules\Process\Http\Requests\Admin\UpdateProcessRequest;
use Modules\Process\Resource\Admin\ProcessSelectResource;
use Modules\Process\Resource\Admin\ProcessWithRelationSelectResource;
use Modules\Process\Resource\Admin\ProcessResource;

use Modules\Process\Services\ProcessService;

class ProcessAdminController extends Controller
{
    public function __construct(
        public ProcessService $processService,
        public HTTPResponse $httpResponse,
    ){}

    public function index(): JsonResponse
    {
        try {
            $processes = $this->processService->getProcesses();
            return $this->httpResponse->ok([
                'data'  =>  ProcessResource::collection($processes),
                'link'  =>  route('processes.admin.index')
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function toSelect(): JsonResponse
    {
        try {
            $processes = $this->processService->getProcesses();
            return $this->httpResponse->ok([
                'data'  =>  ProcessSelectResource::collection($processes),
                'links' =>  route('processes.admin.select')
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function toSelectWithRelation(): JsonResponse
    {
        try {
            $processes = $this->processService->getProcesses();
            return $this->httpResponse->ok([
                'data'  =>  ProcessWithRelationSelectResource::collection($processes),
                'links' =>  route('processes.admin.select_with_relation')
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function store(StoreProcessRequest $request): JsonResponse
    {
        try {
            $process = $this->processService->createProcess($request->processData);
            return $this->httpResponse->created([
                'data' => [
                    'type'      => 'process',
                    'id'        => $process->id,
                    'attributes'=> [
                        'title' => $process->title,
                    ],
                    "relationships" => $process->elections()
                ],
                'link' => [
                    'self'      => route('processes.admin.show', $process->slug),
                    'related'   => route('processes.admin.index'),
                ]
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function show($slug): JsonResponse
    {
        try {
            $process = $this->processService->getProcess($slug);
            return $this->httpResponse->created([
                'data' => [
                    'type'      => 'process',
                    'id'        => $process->id,
                    'attributes'=> [
                        'title'         => $process->title,
                        'subtitle'      => $process->subtitle,
                        'slogan'        => $process->slogan,
                        'description'   => $process->description,
                        'calendar'      => $process->calendar,
                    ],
                    'relationships' => [
                        'elections'     => $process->elections,
                    ],
                    'meta' => [
                        'organizationCount' => $process->organizationCount(),
                        'candidateCount'    => $process->candidateCount(),
                    ]
                ],
                'link' => [
                    'self'      => route('processes.admin.show', $process->slug),
                    'related'   => route('processes.admin.index'),
                ]
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function update(UpdateProcessRequest $request, $id): JsonResponse
    {
        try {
            $process = $this->processService->updateProcess($request->processData, $id);
            return $this->httpResponse->ok(
                [
                    'data' =>
                        [
                            'type'      => 'process',
                            'id'        => $process->id,
                        ],
                    'attributes'=>
                        [
                            $process->getChanges()
                        ],
                    'link' =>
                        [
                            'self'      => route('processes.admin.show', $process->slug),
                            'related'   => route('processes.admin.index'),
                        ]
                ]
            );
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $process = $this->processService->deleteProcess($id);
            return $this->httpResponse->created([
                'data' => $process,
            ]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

}
