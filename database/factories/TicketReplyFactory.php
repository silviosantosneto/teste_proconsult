<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketReplyFactory extends Factory
{
    protected $model = TicketReply::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $ticket = Ticket::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'description' => fake()->paragraphs(rand(2, 5), true)
        ];
    }
}
