<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Travel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 15分钟关闭没有支付的订单
        $schedule->call(function () {
            Order::where('status', 'wait')->where('created_at', '<', now()->subMinute(15))->update(['status' => 'close']);
        })->everyFifteenMinutes();

        // 5分钟游记通过审核
        $schedule->call(function () {
            Travel::where('status', 'audit')->where('updated_at', '<', now()->subMinute(5))->update(['status' => 'adopt']);
        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
