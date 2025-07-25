<?php

namespace Modules\User\DTOs;

use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public function __construct(
        public $id,
        public $username,
        public $email,
        public $password,
        public $email_verified_at = null,
        public $status,
        public $can_login,
    ){}
}

