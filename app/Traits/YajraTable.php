<?php

namespace App\Traits;

use Carbon\Carbon;
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
     * Datatable mockup for receivers resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function ReceiversMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.receivers.datatables', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.receivers.status', compact('data'));
            })
            ->editColumn('valid_from', function ($data) {
                return Carbon::parse($data->valid_from)->format('d-m-Y');
            })
            ->editColumn('valid_until', function ($data) {
                return Carbon::parse($data->valid_until)->format('d-m-Y');
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
            ->editColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d-m-Y');
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for trashed submission resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function TrashedSubmissionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.submission.trashed_btn', compact('data'));
            })
            ->editColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d-m-Y');
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
