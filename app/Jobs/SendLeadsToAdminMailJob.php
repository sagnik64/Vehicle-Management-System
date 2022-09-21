<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\SendLeadsToAdminMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendLeadsToAdminMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public User $user1;
    public User $user2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user1, User $user2)
    {
        {
        $this->user1 = $user1;
        $this->user2 = $user2;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user1->email)->send(new SendLeadsToAdminMail($this->user1, $this->user2));
    }
}
