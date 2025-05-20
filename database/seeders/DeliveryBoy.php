<?php

namespace Database\Seeders;

use App\Models\DeliveryBoy as ModelsDeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryBoy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boys=[
            ['name' => 'A', 'capacity' => 2],
            ['name' => 'B', 'capacity' => 4],
            ['name' => 'C', 'capacity' => 5],
            ['name' => 'D', 'capacity' => 3],
        ];
        foreach ($boys as $boy) {
            ModelsDeliveryBoy::create($boy);
        }
    }
}
