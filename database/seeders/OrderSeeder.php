<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 20; $i++){
            Order::create([
                'number_order' => 'ORD'.str_pad($i, 4, '0', ),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
