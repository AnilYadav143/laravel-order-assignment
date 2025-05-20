<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;


app(Schedule::class)->command('assign-orders')->everyMinute();

Log::info('Assign Orders scheduled in routes/console.php');

