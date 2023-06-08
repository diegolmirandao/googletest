<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Ticket\TicketStatus;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketStatus::upsert([
            [
                'id' => 1,
                'name' => 'PENDIENTE'
            ],
            [
                'id' => 2,
                'name' => 'CONTESTADO'
            ],
            [
                'id' => 3,
                'name' => 'RESPUESTA CLIENTE'
            ],
            [
                'id' => 4,
                'name' => 'CERRADO'
            ],
        ], 'id');
    }
}
