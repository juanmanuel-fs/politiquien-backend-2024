<?php

namespace Modules\Process\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Repositories\AdditionalInformationRepository;
use Modules\Politician\Repositories\BasicRepository;
use Modules\Politician\Repositories\CollegeRepository;
use Modules\Politician\Repositories\CriminalSentenceRepository;
use Modules\Politician\Repositories\ElectedRepository;
use Modules\Politician\Repositories\GeneralRepository;
use Modules\Politician\Repositories\ImmovableRepository;
use Modules\Politician\Repositories\IncomeRepository;
use Modules\Politician\Repositories\MovableRepository;
use Modules\Politician\Repositories\NotCollegeRepository;
use Modules\Politician\Repositories\ObligatorySentenceRepository;
use Modules\Politician\Repositories\OccupationRepository;
use Modules\Politician\Repositories\OtherPostgraduateRepository;
use Modules\Politician\Repositories\PartisanRepository;
use Modules\Politician\Repositories\PostgraduateRepository;
use Modules\Politician\Repositories\PropertyRepository;
use Modules\Politician\Repositories\RenunciationRepository;
use Modules\Politician\Repositories\TechnicalRepository;
use Modules\Process\Data\CandidateData;
use Modules\Process\Models\Candidate;
use Modules\Process\Models\Process;
use Modules\Process\Repositories\CandidateRepository;
use Modules\Process\Repositories\ElectionableRepository;
use Modules\Process\Repositories\OrganizationRepository;
use Modules\Process\Repositories\PositionRepository;
use Modules\Process\Repositories\PostulationRepository;
use Modules\Process\Repositories\ProcessRepository;
use Modules\Utility\Models\Country;
use Modules\Utility\Models\Province;
use Modules\Utility\Models\State;
use Modules\Utility\Models\District;
use Modules\Utility\Repositories\CountryRepository;
use Modules\Utility\Repositories\DistrictRepository;
use Modules\Utility\Repositories\ProvinceRepository;
use Modules\Utility\Repositories\StateRepository;

use Illuminate\Pagination\LengthAwarePaginator;

use function PHPUnit\Framework\throwException;

class CandidateService extends CandidateRepository
{
    protected Process $currentProcess;
    public function __construct(
        protected CandidateRepository $candidateRepository,
        protected GeneralRepository $generalRepository,
        protected ProcessRepository $processRepository,
        protected OrganizationRepository $organizationRepository,
        protected DistrictRepository $districtRepository,
        protected CountryRepository $countryRepository,
        protected StateRepository $stateRepository,
        protected ProvinceRepository $provinceRepository,
        protected ElectionableRepository $electionableRepository,
        protected PostulationRepository $postulationRepository,
        protected PositionRepository $positionRepository,

        protected OccupationRepository $occupationRepository,
        protected BasicRepository $basicRepository,
        protected TechnicalRepository $technicalRepository,
        protected CollegeRepository $collegeRepository,
        protected NotCollegeRepository $notCollegeRepository,
        protected PostgraduateRepository $postgraduateRepository,
        protected OtherPostgraduateRepository $otherPostgraduateRepository,
        protected PartisanRepository $partisanRepository,
        protected ElectedRepository $electedRepository,
        protected RenunciationRepository $renunciationRepository,
        protected IncomeRepository $incomeRepository,
        protected ImmovableRepository $immovableRepository,
        protected MovableRepository $movableRepository,
        protected PropertyRepository $propertyRepository,
        protected CriminalSentenceRepository $criminalSentenceRepository,
        protected ObligatorySentenceRepository $obligatorySentenceRepository,
        protected AdditionalInformationRepository $additionalInformationRepository,


    ){
         $this->currentProcess = $this->processRepository->current();
    }

    /**
     * @throws Exception
     */
    public function getCandidate($id): Candidate
    {
        $candidate = $this->candidateRepository->find($id);
        if($candidate)
            throw new Exception('Candidate not found');

        return $this->getCandidate($id);
    }

    public function getCandidates(): ?Collection
    {
        $candidates = $this->candidateRepository->all();
        if(!$candidates)
            throw new \Exception('No candidates found');

        return $candidates;
    }

    public function getActiveCandidates( $pagination = 12): ?LengthAwarePaginator
    {
        $candidates = $this->candidateRepository->allActive($pagination);
        if(!$candidates)
            throw new Exception('No candidates active found');

        return $candidates;
    }

    public function createPresidentialCandidate(CandidateData $candidateData): ?Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $country = $this->countryRepository->findByUbigeo($candidateData->postulation->ubigeo);
        $electionable = $this->electionableRepository->findObjectModel(Country::class, $country->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $this->currentProcess->id, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;
    }

    public function createCongressmanCandidate(CandidateData $candidateData): ?Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $state = $this->stateRepository->findByUbigeo($candidateData->postulation->ubigeo);
        $electionable = $this->electionableRepository->findObjectModel(State::class, $state->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $candidateData->processId, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;
    }

    public function createAndeanParliamentCandidate(CandidateData $candidateData): ?Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $country = $this->countryRepository->findByUbigeo($candidateData->postulation->ubigeo);
        $electionable = $this->electionableRepository->findObjectModel(Country::class, $country->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $candidateData->processId, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;
    }

    public function createRegionalCandidate(CandidateData $candidateData): Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $state = $this->stateRepository->findByUbigeo($candidateData->postulation->ubigeo);

        $electionable = $this->electionableRepository->findObjectModel(State::class, $state->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $candidateData->processId, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;
    }

    public function createProvinceCandidate(CandidateData $candidateData): Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $province = $this->provinceRepository->findByUbigeo($candidateData->postulation->ubigeo);

        $electionable = $this->electionableRepository->findObjectModel(Province::class, $province->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $candidateData->processId, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;

    }

    public function createDistrictCandidate(CandidateData $candidateData): ?Candidate
    {
        $organization = $this->organizationRepository->findOrCreate($candidateData->postulation->organization);

        $district = $this->districtRepository->findByUbigeo($candidateData->postulation->ubigeo);
        
        $electionable = $this->electionableRepository->findObjectModel(District::class, $district->id);
  
        $postulation = $this->postulationRepository->findOrCreate($candidateData->postulation, $electionable->id, $candidateData->processId, $organization->id);

        $position = $this->positionRepository->findByName($candidateData->postulation->position);

        $candidate = $this->candidateRepository->create($candidateData, $postulation->id, $position->id);

        $this->createLifeInfo($candidateData, $candidate);

        if (!$candidate) {
            throw new \Exception('Electionable not candidate');
        }

        return $candidate;
    }

    private function createLifeInfo(CandidateData $candidateData, $candidate): void
    {

        $this->generalRepository->create($candidateData->general, $candidate->id);

        if($candidateData->occupations)
        {
            foreach ($candidateData->occupations as $occupation)
            {
                $this->occupationRepository->create($occupation, $candidate->id);
            }
        }

        if($candidateData->basics)
        {
            foreach ($candidateData->basics as $basic)
            {
                $this->basicRepository->create($basic, $candidate->id);
            }
        }

        if($candidateData->technicals)
        {
            foreach ($candidateData->technicals as $technical)
                $this->technicalRepository->create($technical, $candidate->id);
        }

        if($candidateData->colleges)
        {
            foreach ($candidateData->colleges as $college)
                $this->collegeRepository->create($college, $candidate->id);
        }

        if($candidateData->notColleges)
        {
            foreach ($candidateData->notColleges as $notCollege)
                $this->notCollegeRepository->create($notCollege, $candidate->id);
        }

        if($candidateData->postgraduates)
        {
            foreach ($candidateData->postgraduates as $postgraduate)
                $this->postgraduateRepository->create($postgraduate, $candidate->id);
        }

        if($candidateData->otherPostgraduates)
        {
            foreach ($candidateData->otherPostgraduates as $otherPostgraduate)
                $this->otherPostgraduateRepository->create($otherPostgraduate, $candidate->id);
        }

        // Political trajectory

        if($candidateData->partisans)
        {
            foreach ($candidateData->partisans as $partisan){
                $organization = $this->organizationRepository->findOrCreate($partisan->organization);
                $this->partisanRepository->create($partisan, $organization, $candidate->id);
            }
        }

        if($candidateData->electeds)
        {
            foreach ($candidateData->electeds as $elected)
                $organization = $this->organizationRepository->findOrCreate($elected->organization);
                $this->electedRepository->create($elected, $organization, $candidate->position_id ,$candidate->id);
        }

        if($candidateData->renunciations)
        {
            foreach ($candidateData->renunciations as $renunciation)
                $organization = $this->organizationRepository->findOrCreate($renunciation->organization);
                $this->renunciationRepository->create($renunciation, $organization, $candidate->id);
        }

        if($candidateData->incomes)
        {
            foreach ($candidateData->incomes as $income)
                $this->incomeRepository->create($income, $candidate->id);
        }

        if($candidateData->immovables)
        {
            foreach ($candidateData->immovables as $immovable)
                $this->immovableRepository->create($immovable, $candidate->id);
        }

        if($candidateData->movables)
        {
            foreach ($candidateData->movables as $movable)
                $this->movableRepository->create($movable, $candidate->id);
        }

        if($candidateData->properties)
        {
            foreach ($candidateData->properties as $property)
                $this->propertyRepository->create($property, $candidate->id);
        }

        if($candidateData->criminalSentences)
        {
            foreach ($candidateData->criminalSentences as $criminalSentence)
                $this->criminalSentenceRepository->create($criminalSentence, $candidate->id);

        }

        if($candidateData->obligatorySentences)
        {
            foreach ($candidateData->obligatorySentences as $obligatorySentence)
                $this->obligatorySentenceRepository->create($obligatorySentence, $candidate->id);
        }

        if($candidateData->additionalInformations)
        {
            foreach ($candidateData->additionalInformations as $additionalInformation)
                $this->additionalInformationRepository->create($additionalInformation, $candidate->id);
        }

    }

}
