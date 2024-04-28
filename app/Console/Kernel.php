<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Schedule as ModelsSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $taskSchedules = ModelsSchedule::all();

        foreach ($taskSchedules as $key => $taskSchedule) {
            $params = $taskSchedule->params; // here url is stored
            if ($params) {
                $schedule->call(function () use ($params) {
                    $response = Http::get($params);

                    if ($response->successful()) {
                        Log::info("Request to $params successful.");
                    } else {
                        Log::error("Failed to request $params: " . $response->status());
                    }
                })->{$taskSchedule->frequency}()->name($taskSchedule->name);
            } else {
                Log::warning("URL not found for task schedule '{$taskSchedule->name}'.");
            }
        }


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
