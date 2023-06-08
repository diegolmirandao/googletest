<?php

namespace Database\Factories\Staff\Ticket;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff\Ticket\Ticket;

class TicketReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'message' => $this->faker->paragraphs(rand(20,100), true),
        ];
    }
}
