<?php

namespace App\Services;

use App\Enums\TicketStatusEnum;
use App\Enums\UserTypesEnum;
use App\Helpers\TicketHelper;
use App\Http\Requests\StoreRequest;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    protected Authenticatable|null|User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function listTickets(): Collection
    {
        return ($this->user->type_id === UserTypesEnum::CLIENT) ?
            Ticket::where('user_id', $this->user->id)->orderByDesc('updated_at')->get() :
            Ticket::whereIn('status_id', [TicketStatusEnum::OPEN, TicketStatusEnum::PROCESSING])
                ->orderByDesc('updated_at')
                ->get();
    }

    public function showTicket(int $id): Ticket
    {
        $ticket = ($this->user->type_id === UserTypesEnum::CLIENT) ?
            $this->user->tickets()->where('id', $id)->first() :
            Ticket::where('id', $id)->first();

        $ticket->links = TicketHelper::setAttachmentLinks($ticket->files);

        $ticket->replies = TicketHelper::getTicketReplies($ticket->id);

        return $ticket;

    }

    public function storeTicket(StoreRequest $request): Ticket
    {
        $files = TicketHelper::storeFiles($request, $this->user->id);
        return Ticket::create([
            'user_id' => $this->user->id,
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => TicketStatusEnum::OPEN,
            'files' => $files
        ]);
    }

    public function storeReply(StoreRequest $request): TicketReply
    {
        $files = TicketHelper::storeFiles($request, $this->user->id);

        if ($this->user->type_id === UserTypesEnum::COLLABORATOR) {
            $ticket = Ticket::where('id', $request->ticket_id)->first();
            $ticket->status_id = TicketStatusEnum::PROCESSING;
            $ticket->save();
        }

        return TicketReply::create([
            'user_id' => $this->user->id,
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
            'files' => $files
        ]);
    }

    public function closeTicket(Request $request): void
    {
        $ticket = Ticket::where('user_id', $this->user->id)->where('id', $request->id)->first();
        if ($ticket) {
            $ticket->status_id = TicketStatusEnum::CLOSED;
            $ticket->save();
        }
    }
}
