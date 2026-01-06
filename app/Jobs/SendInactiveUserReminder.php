<?php

namespace App\Jobs;

use App\Mail\InactiveUserReminderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInactiveUserReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new InactiveUserReminderMail($this->user));
        Log::info('Reminder email sent', [
            'user_id' => $this->user->id,
            'email' => $this->user->email
        ]);
    }
}
