<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
{
    $schedule->command('posts:publish')->everyMinute();
}
protected function commands()
{
    $this->load(__DIR__.'/Commands');

    require base_path('routes/console.php');
}
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\PublishScheduledPosts::class,
    ],
];


}
