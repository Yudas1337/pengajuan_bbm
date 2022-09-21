<?php

namespace App\Services;

use App\Http\Requests\ExcelSubmissionRequest;
use App\Http\Requests\SubmissionRequest;
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
     * Handle get a specified Submission by given id from SubmissionRepository
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
            $this->repository->truncateReceiverData($submission_id);
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
        $store_submission = $this->repository->store($data);

        $oldData = $this->repository->show($submission_id);
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
