<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Ticket\TicketDepartment;

class TicketDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketDepartment::upsert([
            [
                'id' => 1,
                'name' => 'SOPORTE'
            ],
            [
                'id' => 2,
                'name' => 'FINANCIERO'
            ],
        ], 'id');
    }
}
