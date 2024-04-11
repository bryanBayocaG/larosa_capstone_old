<?php

namespace App\Console;
use App\Models\SetTime;

use App\Models\RentInfo;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $firstSetTime = SetTime::first();
        $schedule->command('app:check-overdue')->dailyAt($firstSetTime->set_time);

        // $schedule->call(function () {
        //     $today = Carbon::now()->format('Y-m-d');
        //     RentInfo::where('return_date', $today)->where('status', 'Renting')->update(['status' => 'Overdue']);
        // })->everyTenSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
