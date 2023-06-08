<?php

namespace Database\Seeders;

use App\Models\Customer\AcquisitionChannel;
use Illuminate\Database\Seeder;

class AcquisitionChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcquisitionChannel::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'SIN CANAL'
            ]
        );
    }
}
