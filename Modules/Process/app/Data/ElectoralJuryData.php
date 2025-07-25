<?php

namespace Modules\Process\Data;

class ElectoralJuryData
{
    public function __construct(
        public int $electoralJuryId,
        public string $name,
        public string $acronym
    ){}

}
