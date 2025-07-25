<?php

namespace Modules\User\DTOs;

use Spatie\LaravelData\Data;

class LoginDTO extends Data
{
    public function __construct(
        public string $emailOrUsername,
        public string $password,
    ){}

}
