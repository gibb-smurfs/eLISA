<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequestMail extends Mailable
{

    use Queueable,
        SerializesModels;


    private $message = '';
    private $sender = '';
    private $idea_title = '';
    private $idea_id = '';
    private $sender_mail = '';


    public function __construct($message, $sender, $sender_mail, $idea_title, $idea_id)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->sender_mail = $sender_mail;
        $this->idea_title = $idea_title;
        $this->idea_id = $idea_id;
    }

    public function build()
    {
        return $this->subject('New comment on eLISA')->view('ContactMail', ['data' => $this->parseData()]);
    }

    private function parseData()
    {
        return [
            'message' => $this->message,
            'sender' => $this->sender,
            'idea_title' => $this->idea_title,
            'idea_id' => $this->idea_id,
            'sender_mail' => $this->sender_mail
        ];
    }
}
