<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function getUser(): JsonResponse
    {
        $data = $this->userRepository->handleLoginApi(auth()->user()->username);
        return ResponseFormatter::success($data, "Berhasil fetch user");
    }
}
