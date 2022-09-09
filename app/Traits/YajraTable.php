<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait YajraTable
{
    /**
     * Datatable mockup for shipping resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function StationMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.station.datatables', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
