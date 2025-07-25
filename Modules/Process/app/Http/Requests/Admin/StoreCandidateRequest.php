<?php

namespace Modules\Process\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Politician\Data\IncomeData;
use Modules\Politician\Data\AdditionalInformationData;
use Modules\Politician\Data\BasicData;
use Modules\Politician\Data\CollegeData;
use Modules\Politician\Data\CriminalSentenceData;
use Modules\Politician\Data\ElectedData;
use Modules\Politician\Data\GeneralData;
use Modules\Politician\Data\ImmovableData;
use Modules\Politician\Data\MovableData;
use Modules\Politician\Data\NotCollegeData;
use Modules\Politician\Data\ObligatorySentenceData;
use Modules\Politician\Data\OccupationData;
use Modules\Politician\Data\OtherPostgraduateData;
use Modules\Politician\Data\PartisanData;
use Modules\Politician\Data\PostgraduateData;
use Modules\Politician\Data\PropertyData;
use Modules\Politician\Data\RenunciationData;
use Modules\Politician\Data\TechnicalData;
use Modules\Politician\Enums\DegreePostgraduateEnum;
use Modules\Politician\Enums\LevelBasicEnum;
use Modules\Politician\Enums\TypePropertyEnum;
use Modules\Process\Data\CandidateData;
use Modules\Process\Data\OrganizationData;
use Modules\Process\Data\PostulationData;
use Modules\Process\Enums\ElectionEnum;
use Modules\Process\Enums\StateCandidateEnum;
use Modules\Utility\Data\AddressData;

class StoreCandidateRequest extends FormRequest
{
    public CandidateData  $candidateData;

    protected array $occupations = [];

    protected array $basics = [];
    protected array $technicals= [];
    protected array $notColleges = [];
    protected array $colleges = [];
    protected array $postgraduates = [];
    protected array $otherPostgraduates = [];

    protected array $criminalSentences = [];
    protected array $obligatorySentences = [];

    protected array $partisans = [];
    protected array $electeds = [];
    protected array $renunciations = [];

    protected array $incomes = [];
    protected array $immovables = [];
    protected array $movables = [];
    protected array $properties = [];

    protected array $additionalInformations = [];


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'processId'     =>  ['required', 'integer'],
            'jneId'         =>  ['required', 'integer', 'unique:candidates,jne_id'],
            'fullName'      =>  ['required', 'string'],
            'dni'           =>  ['required', 'string'],
            'imageUrl'      =>  ['required', 'string'],
            // Postulation
            'postulation.jneProcessId'  =>  ['required', 'integer'],
            'postulation.jneElectionId' =>  ['required', 'integer'],
            'postulation.department'    =>  ['nullable', 'string'],
            'postulation.province'      =>  ['nullable', 'string'],
            'postulation.district'      =>  ['nullable', 'string'],
            'postulation.ubigeo'        =>  ['nullable', 'string'],
            'postulation.position'      =>  ['nullable', 'string'],
            'postulation.number'        =>  ['nullable', 'integer'],
            'postulation.state'         =>  ['nullable', 'string'],
            'postulation.organization.jneId'    =>  ['nullable', 'integer'],
            'postulation.organization.name'     =>  ['nullable', 'string'],
            // General
            'general.dni'           =>  ['required', 'string', 'unique:generals,dni'],
            'general.name'          =>  ['required', 'string'],
            'general.fatherSurname' =>  ['nullable', 'string'],
            'general.motherSurname' =>  ['nullable', 'string'],
            'general.sex'           =>  ['nullable', 'integer'],
            'general.birth'         =>  ['required', 'string'],
            // General Address
            'general.address.street'    =>  ['nullable', 'string'],
            'general.address.country'   =>  ['nullable', 'string'],
            'general.address.state'     =>  ['nullable', 'string'],
            'general.address.province'  =>  ['nullable', 'string'],
            'general.address.district'  =>  ['nullable', 'string'],
            'general.address.ubigeo'    =>  ['nullable', 'string'],
            // General place of birth
            'general.placeBirth.country'    =>  ['nullable', 'string'],
            'general.placeBirth.state'      =>  ['nullable', 'string'],
            'general.placeBirth.province'   =>  ['nullable', 'string'],
            'general.placeBirth.district'   =>  ['nullable', 'string'],
            'general.placeBirth.ubigeo'     =>  ['nullable', 'string'],
            // Occupatiosn 
            'occupations'   =>  ['nullable', 'array'],
            'occupations.*.workplace'   =>  ['nullable', 'string'],
            'occupations.*.occupation'  =>  ['nullable', 'string'],
            'occupations.*.ruc'         =>  ['nullable', 'string'],
            'occupations.*.startedAt'   =>  ['nullable', 'string'],
            'occupations.*.endedAt'     =>  ['nullable', 'string'],
            'occupations.*.comment'     =>  ['nullable', 'string'],
            'occupations.*.address.street'      =>  ['nullable', 'string'],
            'occupations.*.address.country'     =>  ['nullable', 'string'],
            'occupations.*.address.state'       =>  ['nullable', 'string'],
            'occupations.*.address.province'    =>  ['nullable', 'string'],
            'occupations.*.address.district'    =>  ['nullable', 'string'],
            'occupations.*.address.ubigeo'      =>  ['nullable', 'string'],
            'occupations.*.address.isBirth'     =>  ['nullable', 'boolean'],
            // Education
            // Primary
            'primaryEducation.concluded'    =>  ['nullable', 'boolean'],
            'primaryEducation.level'        =>  ['nullable', 'string'],
            // Secondary
            'secondaryEducation.concluded'  =>  ['nullable', 'boolean'],
            'secondaryEducation.level'      =>  ['nullable', 'string'],
            // Technical education
            'technicalEducations'   =>  ['nullable', 'array'],
            'technicalEducations.*.institute'   =>  ['nullable', 'string'],
            'technicalEducations.*.career'      =>  ['required', 'string'],
            'technicalEducations.*.concluded'   =>  ['nullable', 'boolean'],
            'technicalEducations.*.comment'     =>  ['nullable', 'string'],
            // Not college education
            'notCollegeEducations'  =>  ['nullable', 'array'],
            'notCollegeEducations.*.institute'  =>  ['nullable', 'string'],
            'notCollegeEducations.*.career'     =>  ['nullable', 'string'],
            'notCollegeEducations.*.concluded'  =>  ['nullable', 'boolean'],
            // College education
            'collegeEducations'     =>  ['nullable', 'array'],
            'collegeEducations.*.university'    =>  ['nullable', 'string'],
            'collegeEducations.*.career'        =>  ['nullable', 'string'],
            'collegeEducations.*.concluded'     =>  ['nullable', 'boolean'],
            'collegeEducations.*.isGraduate'    =>  ['nullable', 'boolean'],
            'collegeEducations.*.yearGraduate'  =>  ['nullable', 'integer'],
            'collegeEducations.*.degree'        =>  ['nullable', 'string'],
            'collegeEducations.*.yearDegree'    =>  ['nullable', 'integer'],
            'collegeEducations.*.comment'       =>  ['nullable', 'string'],
            // Postgraduate education
            'postgraduateEducations'    => ['nullable', 'array'],
            'postgraduateEducations.*.university'   =>  ['nullable', 'string'],
            'postgraduateEducations.*.specialty'    =>  ['nullable', 'string'],
            'postgraduateEducations.*.concluded'    =>  ['nullable', 'boolean'],
            'postgraduateEducations.*.isGraduate'   =>  ['nullable', 'boolean'],
            'postgraduateEducations.*.degree'       =>  ['nullable', 'string'],
            'postgraduateEducations.*.yearDegree'   =>  ['nullable', 'integer'],
            'postgraduateEducations.*.comment'      =>  ['nullable', 'string'],
            // other postgraduate education
            'otherPostgraduateEducations'    => ['nullable', 'array'],
            'otherPostgraduateEducations.*.university'   =>  ['nullable', 'string'],
            'otherPostgraduateEducations.*.specialty'    =>  ['nullable', 'string'],
            'otherPostgraduateEducations.*.concluded'    =>  ['nullable', 'boolean'],
            'otherPostgraduateEducations.*.isGraduate'   =>  ['nullable', 'boolean'],
            'otherPostgraduateEducations.*.degree'       =>  ['nullable', 'string'],
            'otherPostgraduateEducations.*.yearDegree'   =>  ['nullable', 'integer'],
            'otherPostgraduateEducations.*.comment'      =>  ['nullable', 'string'],
            // Sentences Criminal
            'criminalSentences'     =>  ['nullable', 'array'],
            'criminalSentences.*.expedient'         =>  ['nullable', 'string'],
            'criminalSentences.*.date'              =>  ['nullable', 'string'],
            'criminalSentences.*.judicialAuthority' =>  ['nullable', 'string'],
            'criminalSentences.*.crime'             =>  ['nullable', 'string'],
            'criminalSentences.*.ruling'            =>  ['nullable', 'string'],
            'criminalSentences.*.morality'          =>  ['nullable', 'string'],
            'criminalSentences.*.otherMorality'     =>  ['nullable', 'string'],
            'criminalSentences.*.rulingFulfilled'   =>  ['nullable', 'string'],
            'criminalSentences.*.comment'           =>  ['nullable', 'string'],
            // Sentences Obligatory
            'obligatorySentences'   =>  ['nullable', 'array'],
            'obligatorySentences.*.expedient'           =>  ['nullable', 'string'],
            'obligatorySentences.*.matter'              =>  ['nullable', 'string'],
            'obligatorySentences.*.judicialAuthority'   =>  ['nullable', 'string'],
            'obligatorySentences.*.ruling'              =>  ['nullable', 'string'],
            'obligatorySentences.*.comment'             =>  ['nullable', 'string'],
            // Elected Transcendences
            'electedTranscendences' =>  ['nullable', 'array'],
            'electedTranscendences.*.startedAt' =>  ['nullable', 'numeric'],
            'electedTranscendences.*.endedAt'   =>  ['nullable', 'numeric'],
            'electedTranscendences.*.comment'   =>  ['nullable', 'string'],
            'electedTranscendences.*.position'  =>  ['nullable', 'string'],
            'electedTranscendences.*.organization.jneId'    =>  ['nullable', 'integer'],
            'electedTranscendences.*.organization.name'     =>  ['nullable', 'string'],
            // Partisan Transcendences
            'partisanTranscendences'    =>  ['nullable', 'array'],
            'partisanTranscendences.*.position'     =>  ['nullable', 'string'],
            'partisanTranscendences.*.startedAt'    =>  ['nullable', 'numeric'],
            'partisanTranscendences.*.endedAt'      =>  ['nullable', 'numeric'],
            'partisanTranscendences.*.comment'      =>  ['nullable', 'string'],
            'partisanTranscendences.*.organization.jneId'    =>  ['nullable', 'integer'],
            'partisanTranscendences.*.organization.name'     =>  ['nullable', 'string'],
            // Renunciation Transcendences
            'renunciationTranscendences'    =>  ['nullable', 'array'],
            'renunciationTranscendences.*.endedAt'  =>  ['nullable', 'numeric'],
            'renunciationTranscendences.*.comment'  =>  ['nullable', 'string'],
            'renunciationTranscendences.*.organization.jneId'    =>  ['nullable', 'integer'],
            'renunciationTranscendences.*.organization.name'     =>  ['nullable', 'string'],
            // Income Declarations
            'incomeDeclarations'    =>  ['nullable', 'array'],
            'incomeDeclarations.*.publicRemuneration'   =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.privateRemuneration'  =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.publicRent'           =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.privateRent'          =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.publicOther'          =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.privateOther'         =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.total'                =>  ['nullable', 'numeric', 'decimal:0,2', 'min:0'],
            'incomeDeclarations.*.year'                 =>  ['nullable', 'integer'],
            // Immovable Declarations
            'immovableDeclarations' =>  ['nullable', 'array'],
            'immovableDeclarations.*.description'   =>  ['nullable', 'string'],
            'immovableDeclarations.*.address'       =>  ['nullable', 'string'],
            'immovableDeclarations.*.sunarp'        =>  ['nullable', 'boolean'],
            'immovableDeclarations.*.recordSunarp'  =>  ['nullable', 'string'],
            'immovableDeclarations.*.autovaluo'     =>  ['nullable', 'decimal:0,4'],
            'immovableDeclarations.*.value'         =>  ['nullable', 'decimal:0,4'],
            'immovableDeclarations.*.comment'       =>  ['nullable', 'string'],
            // Movable Declarations
            'movableDeclarations'   =>  ['nullable', 'array'],
            'movableDeclarations.*.vehicle'         =>  ['nullable', 'string'],
            'movableDeclarations.*.brand'           =>  ['nullable', 'string'],
            'movableDeclarations.*.plate'           =>  ['nullable', 'string'],
            'movableDeclarations.*.model'           =>  ['nullable', 'string'],
            'movableDeclarations.*.characteristic'  =>  ['nullable', 'string'],
            'movableDeclarations.*.year'            =>  ['nullable', 'integer'],
            'movableDeclarations.*.value'           =>  ['nullable', 'decimal:0,4'],
            'movableDeclarations.*.comment'         =>  ['nullable', 'string'],
            // Property Declarations
            'propertyDeclarations'  =>  ['nullable', 'array'],
            'propertyDeclarations.*.legalPerson'    =>  ['nullable', 'string'],
            'propertyDeclarations.*.type'           =>  ['nullable', 'string'],
            'propertyDeclarations.*.quantity'       =>  ['nullable', 'integer'],
            'propertyDeclarations.*.value'          =>  ['nullable', 'decimal:0,4'],
            'propertyDeclarations.*.comment'        =>  ['nullable', 'string'],
            // Additional information
            'additionalInformations'    =>  ['nullable', 'array'],
            'additionalInformations.*.additional'   =>  ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function passedValidation(): void
    {
        $this->complementary();

        $this->candidateData = CandidateData::from([
            'processId'     =>  $this->input('processId'),
            'jneId'         =>  $this->input('jneId'),
            'fullName'      =>  $this->input('fullName'),
            'dni'           =>  $this->input('dni'),
            'imageUrl'      =>  $this->input('imageUrl'),

            'postulation'   =>  PostulationData::from([
                'jneProcessId'  =>  $this->input('postulation.jneProcessId'),
                'jneElectionId' =>  match($this->input('postulation.jneElectionId')){
                    1 => ElectionEnum::PRESIDENTIAL->value,
                    2 => ElectionEnum::CONGRESSMAN->value,
                    3 => ElectionEnum::ANDEAN_PARLIAMENT->value,
                    4 => ElectionEnum::REGIONAL->value,
                    5 => ElectionEnum::PROVINCIAL_MUNICIPAL->value,
                    6 => ElectionEnum::DISTRICT_MUNICIPAL->value,
                },
                'department'    =>  $this->input('postulation.department'),
                'province'      =>  $this->input('postulation.province'),
                'district'      =>  $this->input('postulation.district'),
                'ubigeo'        =>  $this->input('postulation.ubigeo'),
                'position'      =>  $this->input('postulation.position'),
                'number'        =>  $this->input('postulation.number'),
                'state'         =>  match($this->input('postulation.state')){
                    'INADMISIBLE'       =>  StateCandidateEnum::INADMISSIBLE->value,
                    'IMPROCEDENTE'      =>  StateCandidateEnum::UNFAIR->value,
                    'ADMITIDO'          =>  StateCandidateEnum::ADMITTED->value,
                    'TACHA EN TRAMITE'  =>  StateCandidateEnum::CROSS_OUT_IN_PROCESS->value,
                    'INSCRITO'          =>  StateCandidateEnum::SIGNED_UP->value,
                    'TACHADO'           =>  StateCandidateEnum::CROSSED_OUT->value,
                    'EXCLUSION'         =>  StateCandidateEnum::EXCLUDED->value,
                    'APELACION'         =>  StateCandidateEnum::APPEAL->value,
                    'RENUNCIA'          =>  StateCandidateEnum::RENUNCIATION->value,
                    'RETIRO'            =>  StateCandidateEnum::RETREAT->value,
                },
                'organization'          => OrganizationData::from([
                    'jneId'    =>  $this->input('postulation.organization.jneId'),
                    'name'     =>  $this->input('postulation.organization.name'),
                ])
            ]),

            'general' => GeneralData::from([
                'dni'           =>  $this->input('general.dni'),
                'name'          =>  $this->input('general.name'),
                'fatherSurname' =>  $this->input('general.fatherSurname'),
                'motherSurname' =>  $this->input('general.motherSurname'),
                'sex'           =>  $this->input('general.sex'),
                'birth'         =>  $this->input('general.birth'),
                'address'   => AddressData::from([
                    'street'    =>  $this->input('general.address.street'),
                    'country'   =>  $this->input('general.address.country'),
                    'state'     =>  $this->input('general.address.state'),
                    'province'  =>  $this->input('general.address.province'),
                    'district'  =>  $this->input('general.address.district'),
                    'ubigeo'    =>  $this->input('general.address.ubigeo'),
                    'isBirth'   =>  false,
                ]),
                'placeBirth'=> AddressData::from([
                    'country'   =>  $this->input('general.placeBirth.country'),
                    'state'     =>  $this->input('general.placeBirth.state'),
                    'province'  =>  $this->input('general.placeBirth.province'),
                    'district'  =>  $this->input('general.placeBirth.district'),
                    'ubigeo'    =>  $this->input('general.placeBirth.ubigeo'),
                    'isBirth'   =>  true,
                ]),
            ]),

            'occupations'       =>  $this->occupations,
            'basics'            =>  $this->basics,
            'technicals'        =>  $this->technicals,
            'notColleges'       =>  $this->notColleges,
            'colleges'          =>  $this->colleges,
            'postgraduates'     =>  $this->postgraduates,
            'otherPostgraduates'=>  $this->otherPostgraduates,
            'criminalSentences' =>  $this->criminalSentences,
            'obligatorySentences'   =>  $this->obligatorySentences,
            'partisans'         =>  $this->partisans,
            'electeds'          =>  $this->electeds,
            'renunciations'     =>  $this->renunciations,
            'incomes'           =>  $this->incomes,
            'immovables'        =>  $this->immovables,
            'movables'          =>  $this->movables,
            'properties'        =>  $this->properties,
            'additionalInformations' =>  $this->additionalInformations,
        ]);
    }

    protected function complementary(): void
    {
        if($this->input('summary.occupations'))
        {
            foreach($this->input('occupations') as $occupation){
                $this->occupations [] = OccupationData::from([
                    'workplace'     =>  $occupation['workplace'],
                    'occupation'    =>  $occupation['occupation'],
                    'ruc'           =>  $occupation['ruc'],
                    'startedAt'     =>  $occupation['startedAt'],
                    'endedAt'       =>  $occupation['endedAt'],
                    'comment'       =>  $occupation['comment'],
                    'address'       =>  AddressData::from([
                        'street'    =>  $occupation['address']['street'],
                        'country'   =>  $occupation['address']['country'],
                        'state'     =>  $occupation['address']['state'],
                        'province'  =>  $occupation['address']['province'],
                        'district'  =>  $occupation['address']['district'],
                        'ubigeo'    =>  $occupation['address']['ubigeo'],
                        'isBirth'   =>  false,
                    ])
                ]);
            }
        }

        // ------------ //

        $this->basics = [
            BasicData::from([
                'concluded' =>  $this->input('primaryEducation.concluded'),
                'level'     =>  LevelBasicEnum::PRIMARY->value,
            ]),
            BasicData::from([
                'concluded' =>  $this->input('secondaryEducation.concluded'),
                'level'     =>  LevelBasicEnum::SECONDARY->value,
            ]),
        ];

        if($this->input('summary.technicals'))
        {
            foreach($this->input('technicalEducations') as $technical){
                $this->technicals [] = TechnicalData::from([
                    'institute' =>  $technical['institute'],
                    'career'    =>  $technical['career'],
                    'concluded' =>  $technical['concluded'],
                    'comment'   =>  $technical['comment'],
                ]);
            }
        }

        if($this->input('summary.notColleges'))
        {
            foreach($this->input('notCollegeEducations') as $notCollege){
                $this->notColleges [] = NotCollegeData::from([
                    'institute' =>  $notCollege['institute'],
                    'career'    =>  $notCollege['career'],
                    'concluded' =>  $notCollege['concluded'],
                ]);
            }
        }

        if($this->input('summary.colleges'))
        {
            foreach($this->input('collegeEducations') as $college){
                $this->colleges [] = CollegeData::from([
                    'university'    =>  $college['university'],
                    'career'        =>  $college['career'],
                    'concluded'     =>  $college['concluded'],
                    'isGraduate'    =>  $college['isGraduate'],
                    'yearGraduate'  =>  $college['yearGraduate'],
                    'degree'        =>  $college['degree'],
                    'yearDegree'    =>  $college['yearDegree'],
                    'comment'       =>  $college['comment'],
                ]);
            }
        }

        if($this->input('summary.postgraduates'))
        {
            foreach($this->input('postgraduateEducations') as $postgraduate){
                $this->postgraduates [] = PostgraduateData::from([
                    'university'    =>  $postgraduate['university'],
                    'specialty'     =>  $postgraduate['specialty'],
                    'concluded'     =>  $postgraduate['concluded'],
                    'isGraduate'    =>  $postgraduate['isGraduate'],
                    'degree'        =>  $postgraduate['degree'],
                    'yearDegree'    =>  $postgraduate['yearDegree'],
                    'comment'       =>  $postgraduate['comment'],
                ]);
            }
        }

        if($this->input('summary.otherPostgraduates'))
        {
            foreach($this->input('otherPostgraduateEducations') as $otherPostgraduate){
                $this->otherPostgraduates [] = OtherPostgraduateData::from([
                    'university'    =>  $otherPostgraduate['university'],
                    'specialty'     =>  $otherPostgraduate['specialty'],
                    'concluded'     =>  $otherPostgraduate['concluded'],
                    'isGraduate'    =>  $otherPostgraduate['isGraduate'],
                    'degree'        =>  $otherPostgraduate['degree'],
                    'yearDegree'    =>  $otherPostgraduate['yearDegree'],
                    'comment'       =>  $otherPostgraduate['comment'],
                ]);
            }
        }

        // -------------- //

        if($this->input('summary.criminalSentences'))
        {
            foreach($this->input('criminalSentences') as $criminalSentence){
                $this->criminalSentences [] = CriminalSentenceData::from([
                    'expedient'         =>  $criminalSentence['expedient'],
                    'date'              =>  $criminalSentence['date'],
                    'judicialAuthority' =>  $criminalSentence['judicialAuthority'],
                    'crime'             =>  $criminalSentence['crime'],
                    'ruling'            =>  $criminalSentence['ruling'],
                    'morality'          =>  $criminalSentence['morality'],
                    'otherMorality'     =>  $criminalSentence['otherMorality'],
                    'rulingFulfilled'   =>  $criminalSentence['rulingFulfilled'],
                    'comment'           =>  $criminalSentence['comment'],
                ]);
            }
        }

        if($this->input('summary.obligatorySentences'))
        {
            foreach($this->input('obligatorySentences') as $obligatorySentence){

                $this->obligatorySentences [] = ObligatorySentenceData::from([
                    'expedient'         =>  $obligatorySentence['expedient'],
                    'matter'            =>  $obligatorySentence['matter'],
                    'judicialAuthority' =>  $obligatorySentence['judicialAuthority'],
                    'ruling'            =>  $obligatorySentence['ruling'],
                    'comment'           =>  $obligatorySentence['comment'],
                ]);
            }
        }

        // ------- ------//

        if($this->input('summary.partisans'))
        {
            foreach($this->input('partisanTranscendences') as $partisan){
                $this->partisans [] = PartisanData::from([
                    'position'     =>  $partisan['position'],
                    'startedAt'    =>  $partisan['startedAt'],
                    'endedAt'      =>  $partisan['endedAt'],
                    'comment'      =>  $partisan['comment'],
                    'organization' =>  OrganizationData::from([
                        'jneId' =>  $partisan['organization']['jneId'],
                        'name'  =>  $partisan['organization']['name'],
                    ])
                ]);
            }
        }

        if($this->input('summary.electeds'))
        {
            foreach($this->input('electedTranscendences') as $elected){
                $this->electeds [] = ElectedData::from([
                    'startedAt'    =>  $elected['startedAt'],
                    'endedAt'      =>  $elected['endedAt'],
                    'positionId'   =>  $elected['positionId'],
                    'organization' =>  OrganizationData::from([
                        'jneId' =>  $elected['organization']['jneId'],
                        'name'  =>  $elected['organization']['name'],
                    ]),
                    'comment'      =>  $elected['comment'],
                ]);
            }
        }

        if($this->input('summary.renunciations'))
        {
            foreach($this->input('renunciationTranscendences') as $renunciation){
                $this->renunciations [] = RenunciationData::from([
                    'endedAt'      =>  $renunciation['endedAt'],
                    'organization' =>  OrganizationData::from([
                        'jneId' =>  $renunciation['organization']['jneId'],
                        'name'  =>  $renunciation['organization']['name'],
                    ]),
                    'comment'      =>  $renunciation['comment'],
                    ]);
            }
        }

        // ------- ------ //

        if($this->input('summary.incomes'))
        {
            foreach($this->input('incomeDeclarations') as $income){
                $this->incomes [] = IncomeData::from([
                    'publicRemuneration'   =>  $income['publicRemuneration'],
                    'privateRemuneration'  =>  $income['privateRemuneration'],
                    'publicRent'           =>  $income['publicRent'],
                    'privateRent'          =>  $income['privateRent'],
                    'publicOther'          =>  $income['publicOther'],
                    'privateOther'         =>  $income['privateOther'],
                    'total'                =>  $income['total'],
                    'year'                 =>  $income['year'],
                ]);
            }
        }

        if($this->input('summary.immovables'))
        {
            foreach($this->input('immovableDeclarations') as $immovable){
                $this->immovables [] = ImmovableData::from([
                    'description'   =>  $immovable['description'],
                    'address'       =>  $immovable['address'],
                    'sunarp'        =>  $immovable['sunarp'],
                    'recordSunarp'  =>  $immovable['recordSunarp'],
                    'autovaluo'     =>  $immovable['autovaluo'],
                    'value'         =>  $immovable['value'],
                    'comment'       =>  $immovable['comment'],
                ]);
            }
        }

        if($this->input('summary.movables'))
        {
            foreach($this->input('movableDeclarations') as $movable){
                $this->movables [] = MovableData::from([
                    'vehicle'       =>  $movable['vehicle'],
                    'brand'         =>  $movable['brand'],
                    'plate'         =>  $movable['plate'],
                    'model'         =>  $movable['model'],
                    'characteristic'=>  $movable['characteristic'],
                    'year'          =>  $movable['year'],
                    'value'         =>  $movable['value'],
                    'comment'       =>  $movable['comment'],
                ]);
            }
        }

        if($this->input('summary.properties'))
        {
            foreach($this->input('propertyDeclarations') as $property){
                $this->properties [] = PropertyData::from([
                    'legalPerson'   =>  $property['legalPerson'],
                    'type'          =>  match($property['type']){
                        'Acciones'          => TypePropertyEnum::SHARE->value,
                        'Participaciones'   => TypePropertyEnum::PARTICIPATION->value,
                        'other'             => TypePropertyEnum::OTHER->value,
                    },
                    'quantity'      =>  $property['quantity'],
                    'value'         =>  $property['value'],
                    'comment'       =>  $property['comment'],
                ]);
            }
        }

        if($this->input('summary.additionalInformations'))
        {
            foreach($this->input('additionalInformations') as $additionalInformation){
                $this->additionalInformations [] = AdditionalInformationData::from([
                    'additional'   =>  $additionalInformation['additional'],
                ]);
            }
        }

    }

    protected function existDataWithoutResponse(): void
    {
        if(count($this->input('experienciaLaboral')))
        {
            foreach($this->input('experienciaLaboral') as $occupation){
                if($occupation['anioTrabajoDesde'])
                    $this->occupations [] = OccupationData::from([
                        'workplace'     =>  $occupation['centroTrabajo'],
                        'occupation'    =>  $occupation['ocupacionProfesion'],
                        'ruc'           =>  $occupation['rucTrabajo'],
                        'startedAt'     =>  $occupation['anioTrabajoDesde'],
                        'endedAt'       =>  $occupation['anioTrabajoHasta'],
                        'comment'       =>  $occupation['txComentario'],
                        'address'       =>  AddressData::from([
                            'street'    =>  $occupation('direccionTrabajo'),
                            'country'   =>  $occupation('trabajoPais'),
                            'state'     =>  $occupation('trabajoDepartamento'),
                            'province'  =>  $occupation('trabajoProvincia'),
                            'district'  =>  $occupation('trabajoDistrito'),
                            'ubigeo'    =>  $occupation('ubigeoTrabajo'),
                            'isBirth'   =>  false,
                        ])
                    ]);
                
            }
        }

        if(!$this->input('formacionacademica.educacionBasica'))
        {
            $this->basics = [
                BasicData::from([
                    'concluded' =>  ($this->input('formacionAcademica.educacionBasica.concluidoEduPrimaria') == 'SI') ? 1 : 0,
                    'level'     =>  LevelBasicEnum::PRIMARY->value,
                ]),
                BasicData::from([
                    'concluded' =>  ($this->input('formacionAcademica.educacionBasica.concluidoEduSecundaria') == 'SI') ? 1 : 0,
                    'level'     =>  LevelBasicEnum::SECONDARY->value,
                ]),
            ];
        }

        if(count($this->input('formacionAcademica.educacionTecnico')))
        {
            foreach($this->input('formacionAcademica.educacionTecnico') as $technical){
                if (!$technical['carreraTecnico'] && !$technical['cenEstudioTecnico'])
                    break;

                $this->technicals [] = TechnicalData::from([
                    'institute'     =>  $technical['cenEstudioTecnico'],
                    'career'        =>  $technical['carreraTecnico'],
                    '$concluded'    =>  $technical['concluidoEduTecnico'],
                    '$comment'      =>  $technical['txComentario'],
                ]);
            }
        }

        if(count($this->input('formacionAcademica.educacionNoUniversitaria')))
        {
            foreach($this->input('formacionAcademica.educacionNoUniversitaria') as $notCollege){
                if (!$notCollege['carreraNoUni'] && !$notCollege['centroEstudioNoUni'])
                    break;

                $this->notColleges [] = NotCollegeData::from([
                    'institute'     =>  $notCollege['centroEstudioNoUni'],
                    'career'        =>  $notCollege['carreraNoUni'],
                    '$concluded'    =>  $notCollege['concluidoNoUni'],
                ]);      
            }
        }

        if(count($this->input('formacionAcademica.educacionUniversitaria')))
        {
            foreach($this->input('formacionAcademica.educacionUniversitaria') as $college){
                if (!$college['carreraUni'] && !$college['universidad'] )
                    break;

                $this->colleges [] = CollegeData::from([
                    'university'    =>  $college['universidad'],
                    'career'        =>  $college['carreraUni'],
                    'concluded'     =>  $college['concluidoEduUni'],
                    'isGraduate'    =>  $college['egresadoEduUni'],
                    'yearGraduate'  =>  $college['anioBachiller'],
                    'degree'        =>  $college['tituloUni'],
                    'yearDegree'    =>  $college['anioTitulo'],
                    'comment'       =>  $college['txComentario'],
                ]);
            }
        }

        if(count($this->input('formacionAcademica.educacionPosgrado')))
        {
            foreach($this->input('formacionAcademica.educacionPosgrado') as $postgraduate){
                if (!$postgraduate['txCenEstudioPosgrado'] && !$postgraduate['txEspecialidadPosgrado'])
                    break;

                $degree = null;

                if ($postgraduate['esMaestro'] == 'SI')
                    $degree = DegreePostgraduateEnum::MASTER->value;

                if ($postgraduate['esDoctor'] == 'SI')
                    $degree = DegreePostgraduateEnum::DOCTOR->value;

                $this->postgraduates [] = PostgraduateData::from([
                    'university'    =>  $postgraduate['txCenEstudioPosgrado'],
                    'specialty'     =>  $postgraduate['txEspecialidadPosgrado'],
                    'concluded'     =>  ($postgraduate['concluidoPosgrado'] == 'SI') ? 1 : 0,
                    'isGraduate'    =>  ($postgraduate['egresadoPosgrado'] == 'SI') ? 1 : 0,
                    'degree'        =>  $degree,
                    'yearDegree'    =>  $postgraduate['txAnioPosgrado'],
                    'comment'       =>  $postgraduate['txComentario'],
                ]);
            }
        }

        if(count($this->input('formacionAcademica.educacionPosgradoOtro')))
        {
            foreach($this->input('formacionAcademica.educacionPosgradoOtro') as $otherPostgraduate){
                if (!$otherPostgraduate['txEspecialidadPosgrado'])
                    break;

                $this->otherPostgraduates [] = OtherPostgraduateData::from([
                    'university'    =>  $otherPostgraduate['txCenEstudioPosgrado'],
                    'specialty'     =>  $otherPostgraduate['txEspecialidadPosgrado'],
                    'concluded'     =>  ($otherPostgraduate['concluidoPosgrado'] == 'SI') ? 1 : 0,
                    'isGraduate'    =>  ($otherPostgraduate['egresadoPosgrado'] == 'SI') ? 1 : 0,
                    'degree'        =>  (is_numeric($otherPostgraduate['txAnioPosgradoOtro']))? $otherPostgraduate['txAnioPosgradoOtro'] : null,
                    'yearDegree'    =>  $otherPostgraduate['txAnioPosgrado'],
                    'comment'       =>  $otherPostgraduate['txComentario'],
                ]);
            }
        }

        // -------------- //

        if(count($this->input('sentenciaPenal')))
        {
            foreach($this->input('sentenciaPenal') as $criminalSentence){
                if (!$criminalSentence['txExpedientePenal'])
                    break;

                $date = explode("/",$criminalSentence['feSentenciaPenal']);

                $this->criminalSentences [] = CriminalSentenceData::from([
                    'expedient'         =>  $criminalSentence['txExpedientePenal'],
                    'date'              =>  $date[2].'-'.$date[1].'-'.$date[0],
                    'judicialAuthority' =>  $criminalSentence['txOrganoJudiPenal'],
                    'crime'             =>  $criminalSentence['txDelitoPenal'],
                    'ruling'            =>  $criminalSentence['txFalloPenal'],
                    'morality'          =>  $criminalSentence['txModalidad'],
                    'otherMorality'     =>  $criminalSentence['txOtraModalidad'],
                    'rulingFulfilled'   =>  $criminalSentence['txCumpleFallo'],
                    'comment'           =>  $criminalSentence['txComentario'],
                ]);
            }
        }

        if(count($this->input('sentenciaObliga')))
        {
            foreach($this->input('sentenciaObliga') as $obligatorySentence){
                if (!$obligatorySentence['txMateriaSentencia'])
                    break;

                $this->obligatorySentences [] = ObligatorySentenceData::from([
                    'expedient'         =>  $obligatorySentence['txExpedienteObliga'],
                    'matter'            =>  $obligatorySentence['txMateriaSentencia'],
                    'judicialAuthority' =>  $obligatorySentence['txOrganoJuridicialObliga'],
                    'ruling'            =>  $obligatorySentence['txFalloObliga'],
                    'comment'           =>  $obligatorySentence['txComentario'],
                ]);
            }
        }

        // ------- ----_-//

        if(count($this->input('trayectoria.cargoPartidario')))
        {
            foreach($this->input('trayectoria.cargoPartidario') as $partisan){
                if (!$partisan['orgPolCargoPartidario'] && !$partisan['cargoPartidario'])
                    break;

                $this->partisans [] = PartisanData::from([
                    'position'     =>  $partisan['cargoPartidario'],
                    'startedAt'    =>  $partisan['anioCargoPartiDesde'],
                    'endedAt'      =>  $partisan['anioCargoPartiHasta'],
                    'comment'      =>  $partisan['txComentario'],
                    'organization' =>  OrganizationData::from([
                        'jneId' =>  $partisan['idOrgPolCargoPartidario'],
                        'name'  =>  $partisan['orgPolCargoPartidario'],
                    ])
                ]);
            }
        }

        if(count($this->input('trayectoria.cargoEleccion')))
        {
            foreach($this->input('trayectoria.cargoEleccion') as $elected){
                if (!$elected['orgPolCargoElec'])
                    break;

                $this->electeds [] = ElectedData::from([
                    'startedAt'    =>  $elected['anioCargoElecDesde'],
                    'endedAt'      =>  $elected['anioCargoElecHasta'],
                    'organization' =>  $elected['orgPolCargoElec'],
                    'comment'      =>  $elected['txComentario'],
                ]);
            }
        }

        if(count($this->input('renunciaEfectuada')))
        {
            foreach($this->input('renunciaEfectuada') as $renunciation){
                if (!$renunciation['orgPolRenunciaOp'] && !$renunciation['txComentario'])
                    break;

                $this->renunciations [] = RenunciationData::from([
                    'endedAt'      =>  $renunciation['anioRenunciaOp'],
                    'comment'      =>  $renunciation['txComentario'],
                    'organization' =>  $renunciation['orgPolRenunciaOp'],
                ]);
            }
        }

        // ------- ------ //

        if(count($this->input('declaracionJurada.ingreso')))
        {
            foreach($this->input('declaracionJurada.ingreso') as $income){
                if (!$income['totalIngresos'] && !$income['anioIngresos'])
                    break;

                $this->incomes [] = IncomeData::from([
                    'publicRemuneration'   =>  $income['remuBrutaPublico'],
                    'privateRemuneration'  =>  $income['remuBrutaPrivado'],
                    'publicRent'           =>  $income['rentaIndividualPublico'],
                    'privateRent'          =>  $income['rentaIndividualPrivado'],
                    'publicOther'          =>  $income['otroIngresoPublico'],
                    'privateOther'         =>  $income['otroIngresoPrivado'],
                    'total'                =>  $income['totalIngresos'],
                    'year'                 =>  $income['anioIngresos'],
                ]);
            }
        }

        if(count($this->input('declaracionJurada.bienInmueble')))
        {
            foreach($this->input('declaracionJurada.bienInmueble') as $immovable){
                if (!$immovable['tipoBienInmueble'])
                    break;

                $this->immovables [] = ImmovableData::from([
                    'description'   =>  $immovable['tipoBienInmueble'],
                    'address'       =>  $immovable['inmuebleDireccion'],
                    'sunarp'        =>  ($immovable['inmuebleSunarp'] == 1) ? 1 : 0,
                    'recordSunarp'  =>  $immovable['partidaSunarp'],
                    'autovaluo'     =>  $immovable['autovaluo'],
                    'value'         =>  $immovable['flValor'],
                    'comment'       =>  $immovable['comentario'],
                ]);
            }
        }

        if(count($this->input('declaracionJurada.bienMueble')))
        {
            foreach($this->input('declaracionJurada.bienMueble') as $movable){
                if (!$movable['vehiculo'] && !$movable['caracteristica'])
                    break;

                $this->movables [] = MovableData::from([
                    'vehicle'       =>  $movable['vehiculo'],
                    'brand'         =>  $movable['marca'],
                    'plate'         =>  $movable['placa'],
                    'model'         =>  $movable['modelo'],
                    'characteristic'=>  $movable['caracteristica'],
                    'year'          =>  $movable['anio'],
                    'value'         =>  $movable['valor'],
                    'comment'       =>  $movable['comentario'],
                ]);
            }
        }

        if(count($this->input('declaracionJurada.titularidad')))
        {
            foreach($this->input('declaracionJurada.titularidad') as $property){
                if (!$property['txTipoTitularidad'] && !$property['txPersonaJuridica'])
                    break;

                $this->properties [] = PropertyData::from([
                    'legalPerson'   =>  $property['txPersonaJuridica'],
                    'type'          =>  match($property['txTipoTitularidad']){
                        'Acciones'          => TypePropertyEnum::SHARE->value,
                        'Participaciones'   => TypePropertyEnum::PARTICIPATION->value,
                        'other'             => TypePropertyEnum::OTHER->value,
                    },
                    'quantity'      =>  $property['flCantidad'],
                    'value'         =>  $property['flValor'],
                    'comment'       =>  $property['txComentario'],
                ]);
            }
        }

        if(count($this->input('informacionAdicional')))
        {
            foreach($this->input('informacionAdicional') as $additionalInformation){
                if ($additionalInformation['infoAdicional'])
                    break;

                $this->additionalInformations [] = AdditionalInformationData::from([
                    'additional'   =>  $additionalInformation['infoAdicional'],
                ]);
            }
        }
    }
}
