<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

class ContactFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $lastName;
    protected $institution;
    protected $email;
    protected $phone;
    protected $question;

    public function __construct($request)
    {
        $this->name = $request->name;
        $this->lastName = $request['lastname'];
        $this->institution = $request['institution'];
        $this->email = $request['email'];
        $this->phone = $request['phone'];
        $this->question = $request['message'];
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Form Email',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail',
            with:[
                'name' => $this->name,
                'lastname' => $this->lastName,
                'institution' => $this->institution,
                'email' => $this->email,
                'phone' => $this->phone,
                'question' => $this->question,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
