<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Enums\UserTypesEnum;
use App\Models\Ticket;
use App\Helpers\Ticket as TicketHelper;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Lista os chamados conforme o tipo de usuario.
     */
    public function list()
    {
        $user = Auth::user();

        // Se o usuario for 'Cliente' lista todos os seus chamados,
        // caso contrario pega todos em 'Aberto' e 'Em atendimento'

        $tickets = ($user->type_id === UserTypesEnum::CLIENT) ?
            Ticket::where('user_id', Auth::user()->id)->get() :
            Ticket::whereIn('status_id', [TicketStatusEnum::OPEN, TicketStatusEnum::PROCESSING])->get();

        return Inertia::render('Dashboard', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Exibe o conteudo do chamado e suas respostas.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        // Chamado para suporte
        $ticket = Ticket::where('id', $id)->first();
        if ($user->type_id !== UserTypesEnum::COLLABORATOR) {
            $ticket = Auth::user()->tickets()->where('id', $id)->first();
        }
        // Respostas do chamado
        $replies = TicketReply::where('ticket_id', $ticket->id)->get();

        // Definindo links de Anexo
        $links = TicketHelper::setAttachamentLinks($ticket->files);
        $ticket->links = $links;
        foreach ($replies as $reply) {
            if ($reply->files !== []) {
                $links = TicketHelper::setAttachamentLinks($reply->files);
                $reply->links = $links;
            }
        }

        // Definindo se o usurio pode respoder
        ($replies->isEmpty() || $ticket->status_id !== TicketStatusEnum::CLOSED) ?
            $ticket->user_can_respond = true :
            $ticket->user_can_respond = false;

        ($user->type_id === UserTypesEnum::CLIENT && $replies->isEmpty()) ?
            $ticket->user_can_respond = false:
            $ticket->user_can_respond = true;

        return Inertia::render('Ticket', [
            'replies' => $replies,
            'ticket' => $ticket
        ]);
    }

    /**
     * Exibe o formuário para criação de um chamado.
     */
    public function create()
    {
        return Inertia::render('Ticket');
    }

    /**
     * Cria e salva um novo chamado.
     */
    public function createStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        // Arquivos para anexo
        $files = TicketHelper::filesStore($request, Auth::user()->id);

        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => TicketStatusEnum::OPEN,
            'files' => $files
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Cria e salva uma nova resposta.
     */
    public function replyStore(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        // Arquivos para anexo
        $files = TicketHelper::filesStore($request, Auth::user()->id);

        $ticketID = $request->ticket_id;

        $ticketReply = TicketReply::create([
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticketID,
            'description' => $request->description,
            'files' => $files
        ]);

        if (Auth::user()->type_id = UserTypesEnum::COLLABORATOR){
            $ticket = Ticket::where('id', $ticketID)->first();
            $ticket->status_id = TicketStatusEnum::PROCESSING;
            $ticket->save();
        }

        return redirect()->route('dashboard');

    }

    /**
     * Finaliza o chamado.
     */
    public function end(int $ticketID)
    {
        $ticket = Ticket::where('user_id', Auth::user()->id)->where('id', $ticketID)->first();
        if ($ticket) {
            $ticket->status_id = TicketStatusEnum::CLOSED;
            $ticket->save();
        }

        return redirect()->back();
    }
}
