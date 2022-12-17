<?php

namespace App\Services;

use App\Http\Requests\ExcelSubmissionRequest;
use App\Http\Requests\SubmissionRequest;
use App\Http\Requests\SubmissionUpdateRequest;
use App\Imports\UsersImport;
use App\Repositories\SubmissionRepository;
use App\Traits\YajraTable;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SubmissionService
{
    use YajraTable;

    private SubmissionRepository $repository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->repository = $submissionRepository;
    }

    /**
     * Get all submissions from SubmissionRepository with yajra table
     *
     * @return object|null
     */

    public function handleGetAllSubmission(): object|null
    {
        return $this->SubmissionMockup($this->repository->getAll());
    }

    /**
     * Create a submission mockup data.
     *
     * @return object
     */

    public function handleCreateSubmissionMockup(): object
    {
        return $this->repository->store([
            'id' => Uuid::uuid()
        ]);
    }

    /**
     * Handle get a specified SubmissionEvent by given id from SubmissionRepository
     *
     * @param string $id
     *
     * @return object|null
     */

    public function handleShowSubmission(string $id): object|null
    {
        return $this->repository->show($id);
    }

    /**
     * Handle an Excel upload to the server
     *
     * @param ExcelSubmissionRequest $request
     *
     * @return mixed
     */

    public function handleUploadExcel(ExcelSubmissionRequest $request): mixed
    {
        $data = $request->validated();
        $submission_id = $data['submission_id'];
        $oldData = $this->repository->show($submission_id);
        $uploaded_file = $request->file('excel_file');

        if ($oldData->excel_file && $uploaded_file) {
            Storage::delete('public/' . $oldData->excel_file);
        }
        $filename = $uploaded_file->store('submission_file', 'public');

        return $this->repository->update($submission_id, [
            'excel_file' => $filename
        ]);
    }

    /**
     * Handle insert Excel data to database
     *
     * @param ExcelSubmissionRequest $request
     *
     * @return void
     */

    public function insertExcelData(ExcelSubmissionRequest $request): void
    {
        $uploaded_file = $request->file('excel_file');
        Excel::import(new UsersImport, $uploaded_file);
    }

    /**
     * Handle the process to get receiver by given submission id
     *
     * @param string $id
     *
     * @return object|null
     */

    public function handleGetReceiver(string $id): object|null
    {
        return $this->reviewReceiverMockup($this->repository->getReceiverBySubmissionId($id));
    }

    /**
     * Handle the process to softly delete submission by given submission id
     *
     * @param string $id
     *
     * @return mixed
     */

    public function handleDeleteSubmission(string $id): mixed
    {
        return $this->repository->destroy($id);
    }

    /**
     * Handle the process store receivers to SubmissionRepository
     *
     * @param Request $request
     *
     * @return void
     */

    public function handleStoreReceivers(Request $request): void
    {
        $id = $request->id;
        $receivers = $request->receivers;

        foreach ($receivers as $index => $value) {
            $this->repository->storeReceivers($index, $id, $value);
        }
    }

    /**
     * Handle the process store submission to SubmissionRepository
     *
     * @param SubmissionRequest $request
     *
     * @return void
     */

    public function handleStoreSubmission(SubmissionRequest $request): void
    {
        $data = $request->validated();
        $submission_id = $data['submission_id'];
        $store_submission = $this->repository->storeOrUpdate($data);

        $oldData = $this->repository->show($submission_id);

        if ($oldData->letter_file) {
            Storage::delete('public/' . $oldData->letter_file);

        }

        if ($request->hasFile('letter_file')) {
            $filename = $request->file('letter_file')->store('letter_file', 'public');
            $store_submission->update([
                'letter_file' => $filename
            ]);
        }

    }

    /**
     * Handle the process update submission to SubmissionRepository
     *
     * @param SubmissionUpdateRequest $request
     *
     * @return void
     */

    public function handleUpdateSubmission(SubmissionUpdateRequest $request): void
    {
        $data = $request->validated();
        $submission_id = $data['submission_id'];
        $store_submission = $this->repository->storeOrUpdate($data);
        $oldData = $this->repository->show($submission_id);
        if ($request->hasFile('letter_file')) {
            $uploaded_file = $request->file('letter_file');
            if ($oldData->letter_file && $uploaded_file) {
                Storage::delete('public/' . $oldData->letter_file);
            }
            $filename = $uploaded_file->store('letter_file', 'public');
            $store_submission->update([
                'letter_file' => $filename
            ]);
        }
    }

    /**
     * Handle the process to get trashed submission to SubmissionRepository
     *
     * @return object|null
     */

    public function handleTrashedSubmission(): object|null
    {
        return $this->TrashedSubmissionMockup($this->repository->getTrashedSubmission());
    }

    /**
     * Handle the process to restore submission by given id to SubmissionRepository
     *
     * @param string $id
     *
     * @return void
     */

    public function handleRestoreSubmission(string $id): void
    {
        $this->repository->restoreSubmission($id);
    }

    /**
     * get all submission data with penyuluh
     *
     * @return mixed
     */

    public function handleGetSubmissionsByPenyuluh(): mixed
    {
        $disitrict_id = auth()->user()->district_id;
        return $this->VerifiedSubmissionMockup($this->repository->getVerifiedSubmissionByPenyuluh($disitrict_id));
    }

    /**
     * get all submission data with admin tangkap
     *
     * @return mixed
     */

    public function handleGetSubmissionsByTangkap(): mixed
    {
        return $this->VerifiedSubmissionMockup($this->repository->getVerifiedSubmissionByTangkap());
    }

    /**
     * get all submission data with admin pembudidaya
     *
     * @return mixed
     */

    public function handleGetSubmissionsByPembudidaya(): mixed
    {
        return $this->VerifiedSubmissionMockup($this->repository->getVerifiedSubmissionByPembudidaya());
    }

    /**
     * get all submission data by kepala dinas
     *
     * @return mixed
     */

    public function handleGetSubmissionsByKepalaDinas(): mixed
    {
        return $this->VerifiedSubmissionMockup($this->repository->getVerifiedSubmissionByKepalaDinas());
    }

    /**
     * get all unverified submission data with penyuluh
     *
     * @return mixed
     */

    public function handleGetUnverifiedSubmissionsByPenyuluh(): mixed
    {
        $district_id = auth()->user()->district_id;
        return $this->UnverifiedSubmissionMockup($this->repository->getUnverifiedSubmissionByPenyuluh($district_id));
    }

    /**
     * get all unverified submission data with admin tangkap
     *
     * @return mixed
     */

    public function handleGetUnverifiedSubmissionsByTangkap(): mixed
    {
        return $this->UnverifiedSubmissionMockup($this->repository->getUnverifiedSubmissionByTangkap());
    }

    /**
     * get all unverified submission data with admin pembudidaya
     *
     * @return mixed
     */

    public function handleGetUnverifiedSubmissionsByPembudidaya(): mixed
    {
        return $this->UnverifiedSubmissionMockup($this->repository->getUnverifiedSubmissionByPembudidaya());
    }

    /**
     * get all unverified submission data by kepala dinas
     *
     * @return mixed
     */

    public function handleGetUnverifiedSubmissionsByKepalaDinas(): mixed
    {
        return $this->UnverifiedSubmissionMockup($this->repository->getUnverifiedSubmissionByKepalaDinas());
    }

    /**
     * Handle get total quota
     *
     * @param string $submission_id
     *
     * @return int
     */

    public function handleGetTotalQuota(string $submission_id): int
    {
        return $this->repository->handleGetTotalQuota($submission_id);
    }

    /**
     * Handle count all verified submission data event from models.
     *
     *
     * @return int
     */

    public function handleCountVerifiedSubmission(): int
    {
        return $this->repository->countVerifiedSubmission();
    }

    /**
     * Handle count all unverified submission data event from models.
     *
     *
     * @return int
     */

    public function handleCountUnverifiedSubmission(): int
    {
        return $this->repository->countUnverifiedSubmission();
    }

    /**
     * Handle count all rejected submission data event from models.
     *
     *
     * @return int
     */

    public function handleCountRejectedSubmission(): int
    {
        return $this->repository->countRejectedSubmission();
    }

    /**
     * Handle count total quota submission data models.
     *
     *
     * @return int
     */

    public function handleCountTotalQuota(): int
    {
        return $this->repository->countTotalQuota();
    }

    /**
     * Handle count total quota transaction from submission data models.
     *
     *
     * @return int
     */

    public function handleCountTotalQuotaTransaction(): int
    {
        return $this->repository->countQuotaTransaction();
    }

    /**
     * Handle get transaction history from submission data models.
     * using yajra
     *
     * @return object|null
     */

    public function handleGetTransactions(): object|null
    {
        return $this->TransactionMockup($this->repository->getTransactions());
    }

    /**
     * Handle count all quota by district
     *
     * @return int
     */

    public function handleTotalQuotaByDistrict(): int
    {
        $quota = 0;
        $datas = $this->repository->countQuotaByDistrict();
        foreach ($datas as $data) {
            $quota += $data->submission_receivers_sum_default_quota;
        }

        return $quota;
    }

    /**
     * Handle count unverified submission by district
     *
     * @return int
     */

    public function handleTotalUnverifiedSubmissionByDistrict(): int
    {
        return $this->repository->countUnverifiedSubmissionByDistrict();
    }
}
