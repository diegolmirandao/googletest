<?php

namespace Database\Factories\Staff\Ticket;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff\Business\Business;
use App\Models\Staff\Ticket\TicketDepartment;
use App\Models\Staff\Ticket\TicketStatus;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_id' => Business::inRandomOrder()->first()->id,
            'ticket_department_id' => TicketDepartment::inRandomOrder()->first()->id,
            'ticket_status_id' => TicketStatus::inRandomOrder()->first()->id,
            'message' => $this->faker->paragraphs(rand(20,100), true),
        ];
    }
}
