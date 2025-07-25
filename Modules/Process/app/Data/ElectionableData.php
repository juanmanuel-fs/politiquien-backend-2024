<?php

namespace Modules\Process\Data;

class ElectionableData
{
    public function __construct(
        public int $electionableId,
        public string $electionableType,
        public int $electionId
    ){}
}
