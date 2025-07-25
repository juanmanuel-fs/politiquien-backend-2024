<?php

namespace Modules\User\Interfaces;

use Modules\User\DTOs\UserDTO;
use Modules\User\Models\User;

interface UserRepositoryInterface
{
    public function all(): array;
    public function findByEmail($email): ?UserDTO;
    public function find(User $user): ?UserDTO;
    public function create($data): UserDTO;
    public function update(User $user, $data): UserDTO;
    public function elementUpdate(User $user, $element, $datum): bool;
    public function passwordUpdate(User $user, $newPassword): bool;
    public function checkPassword($old, $new): bool;
    public function delete(User $user): bool;
}
