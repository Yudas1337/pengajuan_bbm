<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ReceiversService;
use App\Services\SubmissionService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private SubmissionService $submissionService;
    private ReceiversService $receiversService;

    public function __construct(SubmissionService $submissionService, ReceiversService $receiversService)
    {
        $this->submissionService = $submissionService;
        $this->receiversService = $receiversService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = [
            'totalSubmissions' => $this->submissionService->handleTotalSubmission(),
            'totalReceivers' => $this->receiversService->handleTotalReceiver()
        ];

        return view('dashboard.pages.index', compact('data'));
    }
}
