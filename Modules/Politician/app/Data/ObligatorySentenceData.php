<?php

namespace Modules\Politician\Data;
use Spatie\LaravelData\Data;

class ObligatorySentenceData extends Data
{
    public function __construct(
         public string $expedient,
         public ?string $matter,
         public ?string $judicialAuthority,
         public ?string $ruling,
         public ?string $comment,
    ){}
}
