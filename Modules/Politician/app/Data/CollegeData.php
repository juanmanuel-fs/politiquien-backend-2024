<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CollegeData extends Data
{
    public function __construct(
        public ?string $university,
        public ?string $career,
        public ?int $concluded,
        public ?int $isGraduate,
        public ?int $yearGraduate,
        public ?string $degree,
        public ?int $yearDegree,
        public ?string $comment,
    ){}

}
