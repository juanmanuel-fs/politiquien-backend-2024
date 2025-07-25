<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as JsonResponse;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected HTTPResponse $httpResponse,
        protected UserService $userService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getUsers();
            return $this->httpResponse->ok([
                'data'  => [
                    'type'  => 'users',
                    ''      => $users,
                ],
                'link'  => [
                    'self' => route('users.index'),
                ]
            ]);
        }
        catch (Exception $e) {
            return $this->httpResponse->badRequest([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        //

        return response()->json(['gfhggh'=>'dsfsdffd']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        //

        return response()->json([]);
    }
}
