<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelSubmissionRequest;
use App\Http\Requests\SubmissionRequest;
use App\Models\Submission;
use App\Services\DistrictService;
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

    public function __construct(SubmissionService $submissionService, StationService $stationService, DistrictService $districtService)
    {
        $this->submissionService = $submissionService;
        $this->stationService = $stationService;
        $this->districtService = $districtService;
    }

    /**
     * Display a listing of the resource.
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
        $this->submissionService->handleShowSubmission($submission_id);
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $submission_id
        ];

        return view('dashboard.pages.submission.create', $datas);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        $datas = [
            'stations' => $this->stationService->handleGetAllStations(),
            'districts' => $this->districtService->handleGetAllDistricts(),
            'id' => $submission->id
        ];

        return view('dashboard.pages.submission.create', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

        if ($data) return back()->with('success', 'Berhasil menghapus pengajuan');

        return back()->with('error', 'Data pengajuan sedang digunakan');
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

    public function store(SubmissionRequest $request)
    {
        $this->submissionService->handleStoreSubmission($request);

        session()->flash('success', 'berhasil menambahkan data pengajuan');

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Simpan perubahan data'
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
        $this->submissionService->handleStoreReceivers($request);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Simpan perubahan data'
        ], Response::HTTP_CREATED);
    }
}
