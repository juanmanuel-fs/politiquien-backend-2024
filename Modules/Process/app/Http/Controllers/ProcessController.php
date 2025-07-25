<?php

namespace Modules\Process\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\JsonResponse;
use Modules\Process\Resource\ProcessResource;
use Modules\Process\Services\ProcessService;

class ProcessController extends Controller
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
                'data' => $processes
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
            return $this->httpResponse->ok([new ProcessResource($process)]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }

    public function showCurrent(): JsonResponse
    {
        try {
            $process = $this->processService->getCurrentProcess();
            return $this->httpResponse->ok([new ProcessResource($process)]);
        }
        catch (\Exception $e) {
            return $this->httpResponse->badRequest([$e->getMessage()]);
        }
    }
}
