<?php

namespace App\Console\Commands;

use App\Jobs\SendInactiveUserReminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class InactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for identify the inactive users those are not logged in past 7 days. This command will be used for make a schedule';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = config('config.inactivityTime', 30);
        $cutoffDate = Carbon::now   ()->subDays($days);
        $inactiveUsers = User::where('is_admin', false)
            ->where('last_login_at', '<=', $cutoffDate)
            ->get();
        foreach ($inactiveUsers as $user) {
            SendInactiveUserReminder::dispatch($user);
        }
    }
}
