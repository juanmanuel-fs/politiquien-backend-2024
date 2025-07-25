<?php

namespace Modules\Politician\Data;
use Modules\Politician\Enums\DegreePostgraduateEnum;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class PostgraduateData extends Data
{
    public function __construct(
        public ?string $university,
        public ?string $specialty,
        public ?int $concluded,
        public ?int $isGraduate,
        public ?DegreePostgraduateEnum $degree,
        public ?int $yearDegree,
        public ?string $comment,
    ){}

}
