<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The URL
     * @param String url
     */
    public $link;

    /**
     * The Participant instance
     * @param Participant participant
     */
    public $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participant, $link)
    {
        $this->participant = $participant;
        $this->link = $link;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->from('info@ia-calendars.infracounter.com', "IA-Calendar's")
                    ->subject( __('messages.emails.password_reset.subject') )
                    ->view('emails.user-password-reset')
                    ->text('emails.user-password-reset_plain-text');
    }
}
