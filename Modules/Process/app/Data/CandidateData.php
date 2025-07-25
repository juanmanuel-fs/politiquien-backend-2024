<?php

namespace Modules\Process\Data;

use Illuminate\Database\Eloquent\Collection;
use Modules\Politician\Data\AdditionalInformationData;
use Modules\Politician\Data\BasicData;
use Modules\Politician\Data\CollegeData;
use Modules\Politician\Data\CriminalSentenceData;
use Modules\Politician\Data\ElectedData;
use Modules\Process\Data\PostulationData;
use Modules\Politician\Data\GeneralData;
use Modules\Politician\Data\ImmovableData;
use Modules\Politician\Data\IncomeData;
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
use Modules\Utility\Data\AddressData;
use Spatie\LaravelData\Data;

class CandidateData extends Data
{
    public function __construct(
        public string $processId,
        public string $jneId,
        public string $fullName,
        public string $dni,
        public string $imageUrl,

        // postulation
        public PostulationData $postulation,

        // politician
        public GeneralData $general,

        /**
         * @param Collection<int, BasicData> $basics
         */
        public array $basics,

        /**
         * @param Collection<int, TechnicalData> $technicals
         */
        public array $technicals,

        /**
         * @param Collection<int, NotCollegeData> $notColleges
         */
        public array $notColleges,

        /**
         * @param Collection<int, OtherPostgraduateData> $otherPostgraduates
         */
        public array $otherPostgraduates,

        /**
         * @param Collection<int, CollegeData> $colleges
         */
        public array $colleges,

        /**
         * @param Collection<int, PostgraduateData> $postgraduates
         */
        public array $postgraduates,

        /**
         * @param Collection<int, OccupationData> $occupations
         */
        public array $occupations,

        /**
         * @param Collection<int, IncomeData> $incomes
         */
        public array $incomes,

        /**
         * @param Collection<int, ImmovableData> $immovables
         */
        public array $immovables,

        /**
         * @param Collection<int, MovableData> $movables
         */
        public array $movables,

        /**
         * @param Collection<int, PropertyData> $properties
         */
        public array $properties,

        /**
         * @param Collection<int, ObligatorySentenceData> $obligatorySentences
         */
        public array $obligatorySentences,

        /**
         * @param Collection<int, CriminalSentenceData> $criminalSentences
         */
        public array $criminalSentences,

        /**
         * @param Collection<int, RenunciationData> $renunciations
         */
        public array $renunciations,

        /**
         * @param Collection<int, ElectedData> $electeds
         */
        public array $electeds,

        /**
         * @param Collection<int, PartisanData> $partisans
         */
        public array $partisans,

        /**
         * @param Collection<int, AdditionalInformationData> $additionalInformations
         */
        public array $additionalInformations,

    ) {}
}
