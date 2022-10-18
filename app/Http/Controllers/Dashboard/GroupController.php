<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\District;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class GroupController extends Controller
{
    private GroupService $service;
    private UserService $userService;

    public function __construct(GroupService $groupService, UserService $userService)
    {
        $this->authorizeResource(Group::class);
        $this->service = $groupService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * 
     * @return mixed
     */

    public function index(Request $request) : mixed
    {
        if ($request->ajax()) return $this->service->handleGetAll();
        return view('dashboard.pages.group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'leader' => $this->userService->handleGetGroupLeader()
        ];
        return view('dashboard.pages.group.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupRequest  $request
     * @return RedirectResponse
     */

    public function store(GroupRequest $request) : RedirectResponse
    {
        $this->service->handleStoreGroup($request);
        return to_route('groups.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $datas = [
            'group' => $group,
            'leader' => $this->userService->handleGetGroupLeader()
        ];
        return view('dashboard.pages.group.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupRequest  $request
     * @param  Group group
     * 
     * @return RedirectResponse
     */

    public function update(GroupRequest $request, Group $group) : RedirectResponse
    {
        $this->service->handleUpdateGroup($request, $group->id);
        return to_route('groups.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     *
     * @return RedirectResponse
     */

    public function destroy(Group $group): RedirectResponse
    {
        $destroy = $this->service->handleDeleteGroup($group->id);

        if (!$destroy) return back()->with('errors', trans('alert.delete_constrained'));

        return back()->with('success', trans('alert.delete_success'));
    }

    /**
     * get group by kecamatan
     * 
     * @param District $district
     * 
     * @return JsonResponse
     */
    public function getGroupByKecamatan(District $district): JsonResponse
    {
        return response()->json($this->service->handleGetByKecamatan($district->id));
    }
}
