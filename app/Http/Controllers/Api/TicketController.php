<?php

namespace App\Http\Controllers\Api;

use App\DTO\TicketData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $dto = TicketData::fromRequest($request);
        $ticket = $this->ticketService->create($dto);

        return response()->json([
            'ticket' => TicketResource::make($ticket),
            'message' => 'Заявка успешно создана'
        ], 201);
    }
}
