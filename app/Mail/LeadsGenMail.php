<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class LeadsGenMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), config('app.name')),
            subject: 'You Have a New Lead via ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            // view: 'view.name',
            markdown: 'mails.lead',
            with: [
                'formName' => $this->lead['formName'],
                'name' => $this->lead['name'],
                'phone' => $this->lead['phone'],
                'email' => $this->lead['email'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}