<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait YajraTable
{
    /**
     * Datatable mockup for station resource
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

    /**
     * Datatable mockup for user resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function UserMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.user.datatables', compact('data'));
            })
            ->editColumn('roles.name', function ($data) {
                return $data->roles->first()->name;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for submission resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function SubmissionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.submission.datatables', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.submission.status', compact('data'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for review receiver resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function reviewReceiverMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setRowId('receiver_id')
            ->editColumn('name', function ($data) {
                return view('dashboard.pages.submission.receiver.name', compact('data'));
            })
            ->editColumn('national_identity_number', function ($data) {
                return view('dashboard.pages.submission.receiver.nik', compact('data'));
            })
            ->editColumn('quota', function ($data) {
                return view('dashboard.pages.submission.receiver.quota', compact('data'));
            })
            ->toJson();
    }
}
