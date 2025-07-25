<?php

namespace Modules\User\Interfaces;

use Modules\User\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmailOrUsername(string $emailOrUsername): ?User;
    public function register($request);
    public function emailVerification(string $email);
    public function forgotPassword();
    public function checkPassword(string $old, string $new);
    public function changePassword($request);

}
