<?php

namespace App\Http\Controllers\Admin;

use App\DTO\TicketFilterData;
use App\DTO\TicketStatusData;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function index(Request $request)
    {
        $filter = TicketFilterData::fromRequest($request);
        $tickets = $this->ticketService->getTickets($filter);

        return view('admin.tickets.index', [
            'tickets' => $tickets,
            'sortBy' => $filter->sortBy,
            'sortOrder' => $filter->sortOrder
        ]);
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('customer', 'media');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function changeStatus(Request $request, Ticket $ticket)
    {
        $data = TicketStatusData::fromRequest($request);
        $this->ticketService->changeStatus($ticket, $data);

        return redirect()->back()->with('success', 'Статус обновлен');
    }
}
