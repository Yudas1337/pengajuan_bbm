<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Services\ReceiversService;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class DashboardController extends Controller
{
    private SubmissionService $submissionService;
    private ReceiversService $receiversService;
    private NotificationService $notificationService;

    public function __construct(SubmissionService $submissionService, ReceiversService $receiversService, NotificationService $notificationService)
    {
        $this->submissionService = $submissionService;
        $this->receiversService = $receiversService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $data = [
            'totalVerifiedSubmission' => $this->submissionService->handleCountVerifiedSubmission(),
            'totalUnverifiedSubmission' => $this->submissionService->handleCountUnverifiedSubmission(),
            'totalRejectedSubmission' => $this->submissionService->handleCountRejectedSubmission(),
            'totalReceivers' => $this->receiversService->handleTotalReceiver(),
            'totalQuota' => $this->submissionService->handleCountTotalQuota(),
            'totalQuotaTransaction' => $this->submissionService->handleCountTotalQuotaTransaction()
        ];

        return view('dashboard.pages.index', compact('data'));
    }

    /**
     * Handle Mark As Read Notifications.
     *
     * @return RedirectResponse
     */

    public function markAsRead(): RedirectResponse
    {
        $this->notificationService->handleMarkAsRead();

        return to_route('dashboard.home');
    }
}
