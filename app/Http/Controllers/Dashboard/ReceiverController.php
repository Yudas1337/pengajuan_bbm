<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Receiver;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\DistrictService;
use App\Services\ReceiversService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReceiverRequest;

class ReceiverController extends Controller
{
    private ReceiversService $service;
    private DistrictService $districtService;

    public function __construct(ReceiversService $receiversService, DistrictService $districtService)
    {
        $this->authorizeResource(Receiver::class);
        $this->service = $receiversService;
        $this->districtService = $districtService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */

    public function index(Request $request): mixed
    {
        if ($request->ajax()) return $this->service->handleGetReceivers();

        return view('dashboard.pages.receivers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function create(): View
    {
        $datas = [
            'districts' => $this->districtService->handleGetAllDistricts()
        ];

        return view('dashboard.pages.receivers.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReceiverRequest $request
     *
     * @return RedirectResponse
     */

    public function store(ReceiverRequest $request): RedirectResponse
    {
        $this->service->handleStoreReceiver($request);

        return to_route('receivers.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Receiver $receiver
     *
     * @return View
     */

    public function edit(Receiver $receiver): View
    {
        $districts = $this->districtService->handleGetAllDistricts();

        return view('dashboard.pages.receivers.edit', compact('districts', 'receiver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReceiverRequest $request
     * @param Receiver $receiver
     *
     * @return RedirectResponse
     */
    public function update(ReceiverRequest $request, Receiver $receiver): RedirectResponse
    {
        $this->service->handleUpdateReceiver($request, $receiver->id);
        return to_route('receivers.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Receiver $receiver
     *
     * @return RedirectResponse
     */

    public function destroy(Receiver $receiver): RedirectResponse
    {
        $destroy = $this->service->handleDeleteReceiver($receiver->id);

        if (!$destroy) return back()->with('errors', trans('alert.delete_constrained'));

        return back()->with('success', trans('alert.delete_success'));
    }
}
