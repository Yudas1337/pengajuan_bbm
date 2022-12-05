<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelSubmissionRequest;
use App\Http\Requests\SubmissionRequest;
use App\Http\Requests\SubmissionUpdateRequest;
use App\Models\Submission;
use App\Services\DistrictService;
use App\Services\GroupService;
use App\Services\StationService;
use App\Services\SubmissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    private StationService $stationService;
    private DistrictService $districtService;
    private SubmissionService $submissionService;
    private GroupService $groupService;

    public function __construct(SubmissionService $submissionService, StationService $stationService, DistrictService $districtService, GroupService $groupService)
    {
        $this->authorizeResource(Submission::class);
        $this->submissionService = $submissionService;
        $this->stationService = $stationService;
        $this->districtService = $districtService;
        $this->groupService = $groupService;
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
        if ($request->ajax()) return $this->submissionService->handleGetAllSubmission();
        return view('dashboard.pages.submission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */

    public function create(): RedirectResponse
    {
        $createInstance = $this->submissionService->handleCreateSubmissionMockup();

        return to_route('submission.createForm', $createInstance['id']);
    }

    /**
     * create the form given from mockup instance
     *
     * @param string $submission_id
     *
     * @return View
     */

    public function createForm(string $submission_id): View
    {
        $this->authorize('submit-letter-of-recommendation');

        $this->submissionService->handleShowSubmission($submission_id);
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $submission_id,
            'groups' => $this->groupService->handleFetchGroups(),
            'user_role' => auth()->user()->roles->pluck('name')[0],
        ];
        return view('dashboard.pages.submission.create', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Submission $submission
     *
     * @return View
     */

    public function edit(Submission $submission): View
    {
        $id = $submission->id;
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $id,
            'submission' => $this->submissionService->handleShowSubmission($id),
            'groups' => $this->groupService->handleFetchGroups()
        ];
        // dd($datas);
        return view('dashboard.pages.submission.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubmissionUpdateRequest $request
     *
     * @return JsonResponse
     */

    public function updateSubmission(SubmissionUpdateRequest $request): JsonResponse
    {
        $this->submissionService->handleUpdateSubmission($request);

        session()->flash('success', trans('alert.update_success'));

        return response()->json([
            'success' => true,
            'message' => trans('alert.update_success')
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Submission $submission
     *
     * @return RedirectResponse
     */

    public function destroy(Submission $submission): RedirectResponse
    {
        $data = $this->submissionService->handleDeleteSubmission($submission->id);

        if ($data) return back()->with('success', trans('alert.delete_success'));

        return back()->with('error', trans('alert.delete_constrained'));
    }

    /**
     * Upload a newly Excel file to the server
     *
     * @param ExcelSubmissionRequest $request
     *
     * @return void
     */

    public function uploadExcelToServer(ExcelSubmissionRequest $request): void
    {
        $this->authorize('submit-letter-of-recommendation');
        $this->submissionService->handleUploadExcel($request);
        $this->submissionService->insertExcelData($request);
    }

    /**
     * Get Receiver by given specified submission id
     *
     * @param string $id
     *
     * @return mixed
     */

    public function getReceiverBySubmission(string $id): mixed
    {

        return $this->submissionService->handleGetReceiver($id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SubmissionRequest $request
     * @return JsonResponse
     */

    public function store(SubmissionRequest $request): JsonResponse
    {
        $this->submissionService->handleStoreSubmission($request);

        session()->flash('success', trans('alert.add_success'));

        return response()->json([
            'success' => true,
            'message' => trans('alert.data_change_success')
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created receivers resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function storeReceivers(Request $request): JsonResponse
    {
        $this->authorize('submit-letter-of-recommendation');

        $this->submissionService->handleStoreReceivers($request);

        return response()->json([
            'success' => true,
            'message' => trans('alert.data_change_success')
        ], Response::HTTP_CREATED);
    }

    /**
     * Display list of verified submissions resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */

    public function verified(Request $request): mixed
    {
        $this->authorize('validate-letter-of-recommendation');

        if ($request->ajax()) {
            if (UserHelper::checkRolePenyuluh()) {
                return $this->submissionService->handleGetSubmissionsByPenyuluh();
            } else if (UserHelper::checkRolePembudidaya()) {
                return $this->submissionService->handleGetSubmissionsByPembudidaya();
            } else if (UserHelper::checkRoleTangkap()) {
                return $this->submissionService->handleGetSubmissionsByTangkap();
            } else if (UserHelper::checkRoleKepalaDinas()) {
                return $this->submissionService->handleGetSubmissionsByKepalaDinas();
            }
        }

        return view('dashboard.pages.submission.verified');
    }


    /**
     * show detail verified submission
     * @param Submission $submission
     *
     * @return View
     */

    public function verifiedDetail(Submission $submission): View
    {
        $id = $submission->id;
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $id,
            'submission' => $this->submissionService->handleShowSubmission($id),
            'groups' => $this->groupService->handleFetchGroups()
        ];

        return view('dashboard.pages.submission.verified_detail', $datas);
    }

    /**
     * Display list of unverified submissions resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */

    public function unverified(Request $request): mixed
    {
        $this->authorize('validate-letter-of-recommendation');

        if ($request->ajax()) {
            if (UserHelper::checkRolePenyuluh()) {
                return $this->submissionService->handleGetUnverifiedSubmissionsByPenyuluh();
            } else if (UserHelper::checkRolePembudidaya()) {
                return $this->submissionService->handleGetUnverifiedSubmissionsByPembudidaya();
            } else if (UserHelper::checkRoleTangkap()) {
                return $this->submissionService->handleGetUnverifiedSubmissionsByTangkap();
            } else if (UserHelper::checkRoleKepalaDinas()) {
                return $this->submissionService->handleGetUnverifiedSubmissionsByKepalaDinas();
            }
        }

        return view('dashboard.pages.submission.unverified');
    }

    /**
     * show detail unverified submission
     * @param Submission $submission
     *
     * @return View
     */

    public function unverifiedDetail(Submission $submission): View
    {
        $id = $submission->id;
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $id,
            'submission' => $this->submissionService->handleShowSubmission($id),
            'groups' => $this->groupService->handleFetchGroups()
        ];

        return view('dashboard.pages.submission.unverified_detail', $datas);
    }

    /**
     * show trashed submissions resource in storage.
     *
     * @param Request $request
     * @return mixed
     */

    public function trashedSubmission(Request $request): mixed
    {
        $this->authorize('restore-letter-of-recommendation');

        if ($request->ajax()) return $this->submissionService->handleTrashedSubmission();

        return view('dashboard.pages.submission.trashed');
    }

    /**
     * Restore trashed submission by given specified id.
     *
     * @param string $id
     *
     * @return RedirectResponse
     */

    public function restoreSubmission(string $id): RedirectResponse
    {
        $this->authorize('restore-letter-of-recommendation');

        $this->submissionService->handleRestoreSubmission($id);

        return to_route('submissions.index')->with('success', trans('alert.submission_restore_success'));
    }

    /**
     * handle get total quota receivers
     *
     * @param Submission $submission
     *
     * @return JsonResponse
     *
     */

    public function getTotalQuota(Submission $submission): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->submissionService->handleGetTotalQuota($submission->id)
        ], Response::HTTP_OK);
    }

    /**
     * download submmision view
     *
     * @param Submission $submission
     * @return mixed
     */
    public function downloadLetter(Submission $submission): mixed
    {
        if(($submission->user->national_identity_number == null) && ($submission->user->address == null)){
            return back()->with('errors', "NIK dan alamat pembuat harus diisi !");
        }
        return view('documents.new-recommendation-letter', compact('submission'));
    }
}
