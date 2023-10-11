<?php

namespace App\Http\Controllers;

use App\Enums\UserTypesEnum;
use App\Http\Requests\StoreRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class TicketController extends Controller
{
    public function list(TicketService $ticketService)
    {
        $props = ($ticketService->listTickets()->isEmpty()) ?
            ['errors' => [
                UserTypesEnum::CLIENT->getName() => 'Sem chamadas',
                UserTypesEnum::COLLABORATOR->getName() => 'Sem chamadas para atender'
            ]] :
            ['tickets' => $ticketService->listTickets()];

        return Inertia::render('Dashboard', $props);
    }

    public function show(int $id, TicketService $ticketService)
    {
        $ticket = $ticketService->showTicket($id);
        return Inertia::render('Ticket', [
            'ticket' => $ticket,
            'replies' => $ticket->replies
        ]);
    }

    public function create()
    {
        return Inertia::render('Ticket');
    }

    public function ticketStore(StoreRequest $request, TicketService $ticketService): void
    {
        $ticketService->storeTicket($request);
    }

    public function replyStore(StoreRequest $request, TicketService $ticketService): void
    {
        $ticketService->storeReply($request);
    }

    public function close(Request $request, TicketService $ticketService): void
    {
        $ticketService->closeTicket($request);
    }
}
