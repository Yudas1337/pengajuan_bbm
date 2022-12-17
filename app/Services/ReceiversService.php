<?php

namespace App\Services;

use App\Http\Requests\PrintCardRequest;
use App\Http\Requests\ReceiverRequest;
use App\Repositories\ReceiversRepository;
use App\Traits\YajraTable;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReceiversService
{
    use YajraTable;

    private ReceiversRepository $repository;

    public function __construct(ReceiversRepository $receiversRepository)
    {
        $this->repository = $receiversRepository;
    }

    /**
     * Get all receivers from ReceiversRepository with yajra table
     *
     * @return object|null
     */

    public function handleGetReceivers(): object|null
    {
        return $this->ReceiversMockup($this->repository->getAll());
    }

    /**
     * Store receiver data to receiverRepository
     *
     * @param ReceiverRequest $request
     *
     * @return void
     */

    public function handleStoreReceiver(ReceiverRequest $request): void
    {
        $data = $this->repository->store($request->validated());

        $url = config('app.api_url');

        $image = QrCode::format('png')
            ->size(500)
            ->generate($url . 'receiver/' . $data['national_identity_number']);
        $output_file = 'qr_file/' . $data['national_identity_number'] . '.png';
        Storage::disk('public')->put($output_file, $image);

        $this->repository->updateReceiver($data['id'], [
            'barcode' => $output_file
        ]);

    }

    /**
     * update receiver data by given id to receiverRepository
     *
     * @param ReceiverRequest $request
     * @param string $id
     *
     * @return void
     */

    public function handleUpdateReceiver(ReceiverRequest $request, string $id): void
    {
        $show = $this->repository->showReceiver($id);
        $data = $request->validated();

        if ($show->national_identity_number !== $data['national_identity_number']) {
            if (file_exists(storage_path('app/public/' . $show->barcode))) {
                Storage::delete('public/' . $show->barcode);

                $url = config('app.api_url');
                $image = QrCode::format('png')
                    ->size(500)
                    ->generate($url . 'receiver/' . $data['national_identity_number']);
                $output_file = 'qr_file/' . $data['national_identity_number'] . '.png';
                Storage::disk('public')->put($output_file, $image);

                $this->repository->updateReceiver($show['id'], [
                    'barcode' => $output_file
                ]);

            }
        }

        $this->repository->updateReceiver($id, $data);

    }

    /**
     * Delete receiver from receiverRepository
     *
     * @param string $id
     *
     * @return mixed
     */

    public function handleDeleteReceiver(string $id): mixed
    {
        $show = $this->repository->showReceiver($id);

        if (file_exists(storage_path('app/public/' . $show->barcode))) {
            Storage::delete('public/' . $show->barcode);
        }

        return $this->repository->DeleteReceiver($id);
    }

    /**
     * handle check nik
     *
     * @param PrintCardRequest $request
     *
     * @return object|null
     */
    public function handleCheckNik(PrintCardRequest $request): object|null
    {
        $data = $request->validated();
        return $this->repository->getByNik($data['nik']);
    }

    /**
     * Show receiver using specified nik from receiverRepository
     *
     * @param string $nik
     *
     * @return object
     */

    public function handleShowReceiver(string $nik): object
    {
        return $this->repository->show($nik);
    }

    /**
     * Handle count all data event from models.
     *
     *
     * @return mixed
     */

    public function handleTotalReceiver(): int
    {
        return $this->repository->countAll();
    }


}
