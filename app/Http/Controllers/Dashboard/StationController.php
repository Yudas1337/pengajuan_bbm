<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StationRequest;
use App\Models\Station;
use App\Services\StationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StationController extends Controller
{
    private StationService $service;

    public function __construct(StationService $stationService)
    {
        $this->authorizeResource(Station::class);
        $this->service = $stationService;
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
        if ($request->ajax()) return $this->service->handleGetStations();

        return view('dashboard.pages.station.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function create(): View
    {
        return view('dashboard.pages.station.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StationRequest $request
     *
     * @return RedirectResponse
     */

    public function store(StationRequest $request): RedirectResponse
    {
        $this->service->handleStoreStation($request);

        return to_route('stations.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Station $station
     *
     * @return View
     */
    public function edit(Station $station): View
    {
        return view('dashboard.pages.station.edit', compact('station'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StationRequest $request
     * @param Station $station
     *
     * @return RedirectResponse
     */
    public function update(StationRequest $request, Station $station): RedirectResponse
    {
        $this->service->handleUpdateStation($request, $station->id);

        return to_route('stations.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Station $station
     *
     * @return RedirectResponse
     */
    public function destroy(Station $station): RedirectResponse
    {
        $destroy = $this->service->handleDeleteStation($station->id);

        if (!$destroy) return back()->with('errors', trans('alert.delete_constrained'));

        return back()->with('success', trans('alert.delete_success'));
    }
}
