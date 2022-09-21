<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLeadsToAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user1;
    public User $user2;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user1, User $user2)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('leads_mail.markdown');
    }
}
