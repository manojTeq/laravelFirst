<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable; 
// use Illuminate\Mail\Mailable\Content; 
// use Illuminate\Mail\Mailable\Envelope; 
use Illuminate\Queue\SerializesModels;

class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;

    public function __construct($user)
    {
        //
        $this->user=$user;
    }

    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'testing mail',
    //     );
    // }

    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.test',
    //     );
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.test')
                    ->subject('Test Email')
                    ->from('manojkumaryadav7889@gmail.com','Manish')
                    ->with(['user'=>$this->user]);
        // return $this->view('emails.test');
    }
}
