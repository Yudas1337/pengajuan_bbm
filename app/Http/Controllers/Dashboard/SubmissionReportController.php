<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class SubmissionReportController extends Controller
{
    private SubmissionService $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) : mixed
    {
        if($request->ajax()) return $this->submissionService->handleGetSubmissionReport($request);

        return view('dashboard.pages.submission-report.index');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function print(Request $request) : mixed
    {
        $data = $this->submissionService->handlePrintSubmissionReport($request);
        return view('dashboard.pages.submission-report.print', compact('data'));
    }
}
