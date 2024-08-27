<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        Vehicle::create(['type' => 'Motor di bawah 250cc', 'cc' => 250, 'price' => 15000]);
        Vehicle::create(['type' => 'Motor di atas 250cc', 'cc' => 500, 'price' => 30000]);
        Vehicle::create(['type' => 'Mobil pribadi', 'cc' => null, 'price' => 70000]);
        Vehicle::create(['type' => 'Minibus', 'cc' => null, 'price' => 150000]);
    }
}