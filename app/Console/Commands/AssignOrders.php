<?php

namespace App\Console\Commands;

use App\Models\DeliveryAssignment;
use App\Models\DeliveryBoy;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AssignOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign orders to delivery boys based on capacity and delivery duration';

    public function handle()
    {
        $time_duration = now()->subMinutes(30);

        $delivery_boys = DeliveryBoy::all();
        $orders = Order::where('status', 'pending')->get();
        // Log::info('Total pending orders: ' . $orders->count());

        while ($orders->count() > 0) {
            foreach ($delivery_boys as $delivery_boy) {
                $active_assign = DeliveryAssignment::where('delivery_boy_id', $delivery_boy->id)
                    ->where('assigned_at', '>=', $time_duration)
                    ->count();

                $availableSpace = $delivery_boy->capacity - $active_assign;

                Log::info("Delivery Boy: {$delivery_boy->name}, Capacity: {$delivery_boy->capacity}, Active Assignments: $active_assign, Available Space: $availableSpace");

                if ($availableSpace > 0) {
                    $orders_to_assign = $orders->take($availableSpace);

                    foreach ($orders_to_assign as $order) {
                        $assignment = DeliveryAssignment::create([
                            'delivery_boy_id' => $delivery_boy->id,
                            'order_id' => $order->id,
                            'assigned_at' => now(),
                        ]);

                        $order->status = 'in_progress';
                        $order->save();
                    }
                    //  assigned orders Remove from the collection
                    $orders = $orders->slice($availableSpace)->values();
                }

                if ($orders->count() == 0) {
                    break 2;
                }
            }
        }

        $this->info('Orders assigned successfully.');
    }
}
