<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Services\GroupService;
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
    private GroupService $groupService;

    public function __construct(SubmissionService $submissionService, ReceiversService $receiversService, NotificationService $notificationService, GroupService $groupService)
    {
        $this->submissionService = $submissionService;
        $this->receiversService = $receiversService;
        $this->notificationService = $notificationService;
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $data = [];

        if (UserHelper::checkRolePembudidaya() || UserHelper::checkRoleTangkap()) {
            $data = [
                'totalVerifiedSubmission' => $this->submissionService->handleCountVerifiedSubmission(),
                'totalUnverifiedSubmission' => $this->submissionService->handleCountUnverifiedSubmission(),
                'totalRejectedSubmission' => $this->submissionService->handleCountRejectedSubmission(),
                'totalReceivers' => $this->receiversService->handleTotalReceiver(),
                'totalQuota' => $this->submissionService->handleCountTotalQuota(),
                'totalQuotaTransaction' => $this->submissionService->handleCountTotalQuotaTransaction()
            ];
        } elseif (UserHelper::checkRoleKepalaDinas()) {
            $data = [
                'totalUnverifiedSubmission' => $this->submissionService->handleCountUnverifiedSubmission(),
            ];
        } elseif (UserHelper::checkRolePenyuluh()) {
            $data = [
                'totalQuotaByDistrict' => $this->submissionService->handleTotalQuotaByDistrict(),
                'totalUnverifiedSubmissionByDistrict' => $this->submissionService->handleTotalUnverifiedSubmissionByDistrict(),
                'totalReceiverPerYearByDistrict' => $this->groupService->handleTotalReceiverPerYearByDistrict()
            ];
        } elseif (UserHelper::checkRoleKetuaKelompok()) {
            $data = [
                'totalSubmissionThisYear' => $this->submissionService->handleTotalSubmissionThisYear(),
                'totalAcceptedSubmissionQuotaThisYear' => $this->submissionService->handleTotalAcceptedSubmissionQuotaThisYear(),
                'totalProgressSubmission' => $this->submissionService->handleTotalProgressSubmission(),
                'totalDeclinedSubmission' => $this->submissionService->handleTotalDeclinedSubmission()
            ];
        }


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
