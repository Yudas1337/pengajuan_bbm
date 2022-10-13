<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintCardRequest;
use App\Services\ReceiversService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     */
    public function index()
    {
        return view('dashboard.pages.card.index');
    }

    /**
     * check nik
     * 
     * @return RedirectResponse
     */
    public function checkNik(PrintCardRequest $request) : RedirectResponse
    {
        $data = $this->receiverService->handleCheckNik($request);
        if($data){
            return back()->with(['success' => 'Data pengguna ditemukan !', 'data' => $data]);
        }else{
            return back()->with('notfound', 'Data pengguna tidak ditemukan !');
        }
    }

    /**
     * print card
     */
    public function printCard(PrintCardRequest $request)
    {
        $datas = [
            'data' => $this->receiverService->handleCheckNik($request)
        ];
        
        return view('dashboard.pages.card.print', $datas);
    }
}
