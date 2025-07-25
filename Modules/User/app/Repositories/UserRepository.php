<?php

namespace Modules\User\Repositories;

use Modules\User\Interfaces\UserRepositoryInterface;
use Modules\User\DTOs\UserDTO;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{

    public function all(): array
    {
        $users = [];

        foreach (User::all() as $user) {
            $users[] = new UserDTO($user->id, $user->user, $user->email, $user->password, $user->email_verified_at, $user->status, $user->can_login);
        }

        return $users;
    }

    public function find(User $user): ?UserDTO
    {
        return new UserDTO($user->id, $user->user, $user->email, $user->password, $user->email_verified_at, $user->status, $user->can_login);
    }

    public function findByEmail($email): ?UserDTO
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            return new UserDTO($user->id, $user->user, $user->email, $user->password, $user->email_verified_at, $user->status, $user->can_login);
        }

        return null;
    }

    public function create($data): UserDTO
    {
        $user = User::create($data);

        return new UserDTO($user->id, $user->user, $user->email, $user->password, $user->email_verified_at, $user->status, $user->can_login);
    }

    public function update(User $user, $data): UserDTO
    {
        $user->update($data);

        return new UserDTO($user->id, $user->user, $user->email, $user->password, $user->email_verified_at, $user->status, $user->can_login);
    }

    public function elementUpdate(User $user, $element, $datum): bool
    {
        $user[$element] = $datum;
        $user->save();

        return true;
    }

    public function passwordUpdate(User  $user, $newPassword): bool
    {
        $user->password = Hash::make($newPassword);
        $user->save();

        return true;
    }

    public function checkPassword($old, $new): bool
    {
        return Hash::check($old, $new);
    }

    public function delete(User $user): bool
    {
        return (bool)$user ->delete();
    }
}

