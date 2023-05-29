<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Inertia\Inertia;
use Redirect;

use App\Mail\ContactFormEmail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'institution' => ['nullable', 'max:50'],
            'email' => ['required', 'max:100','email'],
            'phone' => ['required', 'regex:/[0-9+\/-]/', 'max:13'],
            'message' => ['required', 'max:2000'],
            'captcha_token'  => [new Recaptcha],
        ]);
        $reveiverEmailAddress = "tarik.horoz@gmail.com";
        if (Mail::to($reveiverEmailAddress)->send(new ContactFormEmail($request))) {
            return redirect()->route("email.success");
        }
        return redirect()->route("email.error");
    }

    public function success()
    {
        return Inertia::render('Notification', [
            'title' => 'Primili smo vaš upit!',
            'description' => 'Trudit ćemo se odgovoriti Vam u najkraćem mogućem roku!',
        ]);
    }

    public function error()
    {
        return Inertia::render('Notification', [
            'title' => 'Greška pri slanju upita!',
            'description' => 'Molimo Vas da nas kontaktirate direktno putem email-a ili telefona!',
        ]);
    }
}
