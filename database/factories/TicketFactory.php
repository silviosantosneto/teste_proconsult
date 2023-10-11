<?php

namespace Database\Factories;

use App\Enums\TicketStatusEnum;
use App\Enums\UserTypesEnum;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => ucfirst(fake()->words(rand(3, 5), true)),
            'description' => fake()->paragraphs(rand(2, 5), true),
            'files' => [],
            'status_id' => fake()->randomElement([TicketStatusEnum::OPEN->value, TicketStatusEnum::PROCESSING->value,
                TicketStatusEnum::CLOSED->value])
        ];
    }
}
