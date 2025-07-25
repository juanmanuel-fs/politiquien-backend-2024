<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;

class OtherPostgraduateData extends Data
{
    public function __construct(
        public ?string $university,
        public ?string $specialty,
        public ?int $concluded,
        public ?int $isGraduate,
        public ?string $degree,
        public ?int $yearDegree,
        public ?string $comment,
    ){}

}
