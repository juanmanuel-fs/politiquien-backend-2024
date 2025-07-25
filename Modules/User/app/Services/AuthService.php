<?php

namespace Modules\User\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Modules\User\DTOs\LoginDTO;
use Modules\User\Models\User;
use Modules\User\Repositories\AuthRepository;

class AuthService
{
    public function __construct(
        protected AuthRepository $authRepository,
        protected AuthManager $authManager
    ){}

    /**
     * @throws Exception
     */
    public function login(LoginDTO $loginDTO): User
    {
        $user = $this->authRepository->findByEmailOrUsername($loginDTO->emailOrUsername);

        if(!$user || !password_verify($loginDTO->password, $user->password)){
            throw new Exception('Credenciales Inválidos');
        }
        return $user;

    }

}
