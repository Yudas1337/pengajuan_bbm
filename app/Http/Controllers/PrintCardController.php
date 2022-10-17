<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintCardRequest;
use App\Services\ReceiversService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PrintCardController extends Controller
{
    private ReceiversService $receiverService;

    public function __construct(ReceiversService $receiverService)
    {
        $this->receiverService = $receiverService;
    }

    /**
     * show searching card by nik
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.card.index');
    }

    /**
     * check nik
     *
     * @param PrintCardRequest $request
     *
     * @return RedirectResponse
     */

    public function checkNik(PrintCardRequest $request): RedirectResponse
    {
        $data = $this->receiverService->handleCheckNik($request);
        if ($data) {
            return back()->with(['success' => 'Data pengguna ditemukan !', 'data' => $data]);
        } else {
            return back()->with('notfound', 'Data pengguna tidak ditemukan !');
        }
    }

    /**
     * print card
     *
     * @param PrintCardRequest $request
     *
     * @return View
     *
     */
    public function printCard(PrintCardRequest $request): View
    {
        $datas = [
            'data' => $this->receiverService->handleCheckNik($request)
        ];

        return view('dashboard.pages.card.print', $datas);
    }
}
