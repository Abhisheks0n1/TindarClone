protected function schedule(Schedule $schedule): void
{
    $schedule->command('users:check-popular')->daily(); // Run daily, adjust as needed
}