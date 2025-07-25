<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Exception;
use Modules\User\Http\Requests\Auth\LoginRequest;
use Modules\User\Services\AuthService;
use Illuminate\Http\JsonResponse as JsonResponse;


class AuthController extends Controller
{
    public function __construct(
        protected AuthService  $authService,
        protected HTTPResponse $httpResponse,
        protected $guard = 'api'
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->login($request->loginData);
            return $this->httpResponse->ok([
                'data' => $user
            ]);
        }
        catch (Exception $e) {
            return $this->httpResponse->badRequest([
                'message' => $e->getMessage()
            ]);
        }
    }

}
