<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact(ContactRequest $request)
    {
        $name = $request->input('name');
        $mail = $request->input('mail');
        $message = $request->input('message');
        
        $bag=compact('name','mail','message');

        $email= new ContactMail($bag);

        Mail::to('fab@fab.it')->send($email);

        return redirect('thankyou');
        
    }
    public function thankyou()
    {
        return view('thankyou');
    }
}
