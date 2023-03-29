<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\DiamondCron::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('diamond:cron-reset')->dailyAt('19:38');
        $schedule->command('diamond:cron-reset')->everyMinute();
        $schedule->command('diamond1:cron-reset')->everyMinute();
        $schedule->command('diamond2:cron-reset')->everyMinute();
        $schedule->command('diamond3:cron-reset')->everyMinute();
        $schedule->command('instagram:cron-reset')->everyMinute();

         //$schedule->command('diamond:cron')->dailyAt('07:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
