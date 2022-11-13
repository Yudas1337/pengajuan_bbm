<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private SubmissionService $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */

    public function index(Request $request): mixed
    {
        if ($request->ajax()) return $this->submissionService->handleGetTransactions();

        return view('dashboard.pages.history.index');
    }
}
