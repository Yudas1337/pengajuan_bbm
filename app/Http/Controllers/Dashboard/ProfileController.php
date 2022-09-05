<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private UserService $service;

    function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.profile.index');
    }

    /**
     * update current user profile
     *
     * @param ProfileRequest $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, User $user)
    {
        $this->service->updateProfile($request, $user->id);

        return redirect()->back()->with('success', 'Berhasil update profil');
    }

    /**
     * show password form
     *
     * @return view
     */

    public function showPasswordForm()
    {
        return view('dashboard.pages.profile.change-password');
    }

    /**
     * Update current user password
     *
     * @param ChangePasswordRequest $request
     *
     * @return RedirectResponse
     */

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->service->changePassword($request);

        return redirect()->back()->with('success', 'Berhasil update password');
    }
}
