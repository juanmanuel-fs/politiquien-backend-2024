<?php

namespace Modules\Process\Http\Controllers\Admin;

use App\Shared\responses\HTTPResponse;
use Modules\Process\Http\Requests\Admin\StoreCandidateRequest;
use Modules\Process\Services\CandidateService;
use Illuminate\Http\JsonResponse;
use Modules\Process\Resource\Admin\CandidatesResource;

class CandidateAdminController
{
    public function __construct(
        protected HTTPResponse $httpResponse,
        protected CandidateService $candidateService,
    ){}

    public function index(){
        try {
            $candidates = $this->candidateService->getActiveCandidates(24);

            return $this->httpResponse->ok([
                'data'  =>  CandidatesResource::collection($candidates),
                'pagination' => [
                    'currentPage' => $candidates->currentPage(),
                    'lastPage'    => $candidates->lastPage(),
                    'perPage'     => $candidates->perPage(),
                    'total'        => $candidates->total(),
                    'nextPageUrl' => $candidates->nextPageUrl(),
                    'prevPageUrl' => $candidates->previousPageUrl(),
                ],
                'links' =>  route('candidates.admin.index')
            ]);
        } catch (\Exception $e) {
            return $this->httpResponse->badRequest([
                'errors'    => $e->getMessage(),
            ]);
        }
    }

    public function store(StoreCandidateRequest $storeCandidateRequest): JsonResponse
    {
        try {
            
            $candidate = match($storeCandidateRequest->candidateData->postulation->jneElectionId){
                1 => $this->candidateService->createPresidentialCandidate($storeCandidateRequest->candidateData),
                2 => $this->candidateService->createCongressmanCandidate($storeCandidateRequest->candidateData),
                3 => $this->candidateService->createAndeanParliamentCandidate($storeCandidateRequest->candidateData),
                4 => $this->candidateService->createRegionalCandidate($storeCandidateRequest->candidateData),
                5 => $this->candidateService->createProvinceCandidate($storeCandidateRequest->candidateData),
                6 => $this->candidateService->createDistrictCandidate($storeCandidateRequest->candidateData),
            };

            return $this->httpResponse->created([
                'data' =>[
                    'type'  => 'candidates',
                    'id'    => '',
                    'attributes' => [
                        'name'   => $storeCandidateRequest->candidateData->postulation->state,
                    ]
                ]
            ]);
        }
        catch (\Exception $e){
            return $this->httpResponse->badRequest([
                'errors'    => $e->getMessage(),
                'jneId'     => $storeCandidateRequest->candidateData->processId
            ]);
        }
    }
}
