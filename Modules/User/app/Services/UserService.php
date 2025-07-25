<?php

namespace Modules\User\Services;

use Exception;
use Modules\User\DTOs\UserDTO;
use Modules\User\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function getUsers(): array
    {
        return $this->userRepository->all();
    }

    public function getUser($id): ?UserDTO
    {
        return $this->userRepository->find($id);
    }

    public function getUserByEmail($email):  ?UserDTO
    {
        return $this->userRepository->findByEmail($email);
    }

    public function createUser($data): UserDTO
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, $data): UserDTO
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * @throws Exception
     */
    public function updateUserPassword($id, $passwords): string
    {
        $user = $this->userRepository->find($id);

        if(!$this->userRepository->checkPassword($user->password, $passwords->current))
        {
            throw new Exception('Las contraseñas no coinciden');
        }

        if($user->password === $passwords->new)
        {
            throw new Exception('Las contraseñas es exactamente que la anterior');
        }

        $this->userRepository->passwordUpdate($user->id, $passwords->new);
        return 'contraseña actualizada';
    }

    public function deleteUser($id): bool
    {
        return $this->userRepository->delete($id);
    }
}
