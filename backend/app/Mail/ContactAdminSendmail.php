<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $username;
    private $email;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->username = $inputs['username'];
        $this->email = $inputs['email'];
        $this->body  = $inputs['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('koshi.futami@gmail.com')
            ->subject('【SOKOMIRU】お問い合わせを受け付けました。')
            ->view('contact.mail_admin')
            ->with([
                'username' => $this->username,
                'email' => $this->email,
                'body'  => $this->body,
            ]);
    }
}
