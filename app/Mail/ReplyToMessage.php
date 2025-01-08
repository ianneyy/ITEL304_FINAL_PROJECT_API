<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyToMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $replyMessage;
    public $senderName;
    public $senderEmail;
    public  $userMessage;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($replyMessage, $senderName, $senderEmail, $userMessage)
    {
        $this->replyMessage = $replyMessage;
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->userMessage = $userMessage;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Reply To Message',
            to: $this->senderEmail,
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
            view: 'emails.reply',
            with: [
                'senderName' => $this->senderName,
                'replyMessage' => $this->replyMessage,
            ],
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
