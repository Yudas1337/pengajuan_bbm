<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Receiver;
use App\Services\ReceiversService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceiverController extends Controller
{
    private ReceiversService $service;

    public function __construct(ReceiversService $receiversService)
    {
        $this->service = $receiversService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Receiver $receiver
     *
     * @return JsonResponse
     */
    public function show(Receiver $receiver): JsonResponse
    {
        return ResponseFormatter::success($receiver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Receiver $receiver
     * @return Response
     */
    public function update(Request $request, Receiver $receiver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Receiver $receiver
     * @return Response
     */
    public function destroy(Receiver $receiver)
    {
        //
    }
}
