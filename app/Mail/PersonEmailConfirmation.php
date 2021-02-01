<?php

namespace App\Mail;

use App\Models\PersonEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PersonEmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The PersonEmail instance
     * @param PersonEmail
     */
    public $person_email;

    /**
     * The PersonEmail instance
     * @param String url
     */
    public $link;

    /**
     * Create a new message instance.
     * @param $person_email PersonEmail to send
     * @param $link for confirmation email
     * @return void
     */
    public function __construct(PersonEmail $person_email, $link )
    {
        $this->person_email = $person_email;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@ia-calendars.infracounter.com', "IA-Calendar's")
                    ->subject( __('messages.emails.confirmation.subject') )
                    ->view('emails.person-email-confirmation')
                    ->text('emails.person-email-confirmation_plain-text');
    }
}
