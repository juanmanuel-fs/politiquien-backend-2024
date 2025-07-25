<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\User\Interfaces\AuthRepositoryInterface;
use Modules\User\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByEmailOrUsername(string $emailOrUsername): ?User
    {
        return User::where('email', $emailOrUsername)->orWhere('username', $emailOrUsername)->first();
    }

    public function register($request)
    {

    }

    public function emailVerification(string $email){

    }

    public function forgotPassword()
    {

    }

    public function checkPassword(string $old, string $new): bool
    {
        return Hash::check($old, $new);
    }

    public function changePassword($request)
    {

    }
}
