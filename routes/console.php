<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// protected function schedule(Schedule $schedule)
// {
//     $schedule->command('users:process')->everyTwoMinutes();
// }


Schedule::command('app:process-user-command')->everyMinute();

