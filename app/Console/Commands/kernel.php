<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
    \App\Console\Commands\AssignOrders::class,
];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('assign-orders')->everyMinute();
    }
}


