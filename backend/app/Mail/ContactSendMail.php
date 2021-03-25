<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class ContactSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_name;
    public $contact_email;
    public $contact_description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->contact_name = $request->contact_name;
        $this->contact_email = $request->contact_email;
        $this->contact_description  = $request->contact_description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【MyDailyLifePHP】お問い合わせ受付/自動送信メール')
            ->view('contact.mail')
            ->with([
                'contact_name' => $this->contact_name,
                'contact_email' => $this->contact_email,
                'contact_description'  => $this->contact_description,
            ]);
    }
}
