<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContactItem;
use App\Models\Admin;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contact_page_item = PageContactItem::where('id', 1)->first();
        return view('front.contact', compact('contact_page_item'));
    }
    public function submit(Request $request)
    {
        $admin_data = Admin::where('id', 1)->first();
        $request->validate([
            'personName' => 'required',
            'personEmail' => 'required|email',
            'personMessage' => 'required',
        ]);

        $subject = 'Contact Message';
        $message = 'Visitors Info: <br>';
        $message .= 'Name: ' . $request->personName . '<br>';
        $message .= 'Email: ' . $request->personEmail . '<br>';
        $message .= 'Message: ' . $request->personMessage;
        Mail::to($admin_data->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Email is sent Successfully! We will contact you soon... Thank You!');
    }
}
