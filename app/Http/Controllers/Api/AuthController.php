<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\Api\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    /**
     * Handle login by rest api.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->service->handleLogin($request);

        return ResponseFormatter::success([
            'user' => $data['user'],
            'token' => $data['token']
        ], "Berhasil login");
    }

    /**
     * Handle logout by rest api.
     *
     * @return JsonResponse
     */

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return ResponseFormatter::success(null, "Berhasil Logout");
        } catch (\Throwable $e) {
            ResponseFormatter::error(null, "Terjadi Kesalahan", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
