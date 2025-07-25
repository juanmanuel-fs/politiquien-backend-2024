<?php

namespace Modules\Politician\services;


class PoliticianService
{
    public function __construct(
        protected BasicService $basicService,
        protected CollegeService $collegeService,
        protected CriminalSentenceService $criminalSentenceService,
        protected ElectedService $electedService,
        protected GeneralService $generalService,
        protected ImmovableService $immovableService,
        protected MovableService $movableService,
        protected NotCollegeService $notCollegeService,
        protected ObligatorySentenceService $obligatorySentenceService,
        protected OccupationService $occupationService,
        protected OtherPostgraduateService $otherPostgraduateService,
        protected PartisanService $partisanService,
        protected PostgraduateService $postgraduateService,
        protected PropertyService $propertyService,
        protected RenunciationService $renunciationService,
        protected TechnicalService $technicalService
    ){}


    public function create(array $data): object
    {

        return $this->basicService->createBasic($data);
    }
}
