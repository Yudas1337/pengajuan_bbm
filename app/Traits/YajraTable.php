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
            ->editColumn('start_time', function ($data) {
                return Carbon::parse($data->start_time)->format('d M Y H:i');
            })
            ->editColumn('end_time', function ($data) {
                return Carbon::parse($data->end_time)->format('d M Y H:i');
            })
            ->editColumn('submission_status', function ($data) {
                $now = now()->format('Y-m-d H:i:s');
                return view('dashboard.pages.submission.submission_status', compact('data', 'now'));
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

    /**
     * Datatable mockup for verified submission resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function VerifiedSubmissionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.submission.verifiedDatatables', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.submission.status', compact('data'));
            })
            ->editColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d-m-Y');
            })
            ->editColumn('start_time', function ($data) {
                return Carbon::parse($data->start_time)->format('d M Y H:i');
            })
            ->editColumn('end_time', function ($data) {
                return Carbon::parse($data->end_time)->format('d M Y H:i');
            })
            ->editColumn('submission_status', function ($data) {
                $now = now()->format('Y-m-d H:i:s');
                return view('dashboard.pages.submission.submission_status', compact('data', 'now'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Datatable mockup for unverified submission resource
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     */

    public function UnverifiedSubmissionMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.pages.submission.unverifiedDatatables', compact('data'));
            })
            ->editColumn('status', function ($data) {
                return view('dashboard.pages.submission.status', compact('data'));
            })
            ->editColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d-m-Y');
            })
            ->editColumn('start_time', function ($data) {
                return Carbon::parse($data->start_time)->format('d M Y H:i');
            })
            ->editColumn('end_time', function ($data) {
                return Carbon::parse($data->end_time)->format('d M Y H:i');
            })
            ->editColumn('submission_status', function ($data) {
                $now = now()->format('Y-m-d H:i:s');
                return view('dashboard.pages.submission.submission_status', compact('data', 'now'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
