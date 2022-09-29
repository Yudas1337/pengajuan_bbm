<?php

namespace App\Services\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class AuthService
{
    private UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Handle login by rest api.
     *
     * @param LoginRequest $request
     *
     * @return array
     */


    public function handleLogin(LoginRequest $request): array
    {
        $validated = $request->validated();

        if (!auth()->attempt($validated)) {
            return ResponseFormatter::error(null, 'Username atau password salah', Response::HTTP_UNAUTHORIZED);
        }

        $user   = $this->repository->handleLoginApi($validated['username']);
        $token  = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
