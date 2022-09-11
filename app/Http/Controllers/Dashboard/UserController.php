<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $userService)
    {
        $this->authorizeResource(User::class);
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */

    public function index(Request $request): mixed
    {
        if ($request->ajax()) return $this->service->handleGetUser();

        return view('dashboard.pages.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return mixed
     */

    public function inactive(Request $request): mixed
    {
        $this->authorize('deactivate-user');

        if ($request->ajax()) return $this->service->handleGetInactiveUsers();

        return view('dashboard.pages.user.inactive');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function create(): View
    {
        $roles = Role::all();
        return view('dashboard.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->service->handleStoreUser($request);

        return to_route('users.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $user
     *
     * @return RedirectResponse
     */
    public function activate(string $user): RedirectResponse
    {
        $this->authorize('activate-user');

        $this->service->handleActivateUser($user);

        return back()->with('success', trans('alert.user_restore_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return View
     */

    public function edit(User $user): View
    {
        $roles = Role::all();
        return view('dashboard.pages.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     *
     * @return RedirectResponse
     */

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $this->service->handleUpdateUser($request, $user);
        return to_route('users.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */

    public function destroy(User $user): RedirectResponse
    {
        $this->service->handleDeleteUser($user->id);

        return to_route('users.index')->with('success', trans('alert.user_soft_delete_success'));
    }
}
