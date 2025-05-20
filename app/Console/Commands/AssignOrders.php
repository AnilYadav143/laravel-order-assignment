<?php

namespace App\Console\Commands;

use App\Models\DeliveryAssignment;
use App\Models\DeliveryBoy;
use App\Models\Order;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $time_duration = now()->subMinutes(3);
        $deliver_boys_list =DeliveryBoy::all();
        $orders = Order::where('status', 'pending')->get();

        while ($orders->count() > 0) {
            foreach ($deliver_boys_list as $deliver_boy) {
                $active_assign =DeliveryAssignment::where('delivery_boy_id', $deliver_boy->id)
                    ->where('assigned_at', '>=', $time_duration)
                    ->count();
                    $availableSpace = $deliver_boy->capacity - $active_assign;
                    if ($availableSpace > 0) {
                        $orders_to_assign = $orders->take($availableSpace);
                        foreach ($orders_to_assign as $order) {
                            DeliveryAssignment::create([
                                'delivery_boy_id' => $deliver_boy->id,
                                'order_id' => $order->id,
                                'assigned_at' => now(),
                            ]);
                            $order->status = 'in_progress';
                            $order->save();
                        }
                    }
                    if($orders->count() == 0) {
                        break;
                    }
                }
            }
            $this->info('Orders assigned successfully.');

    }
}
