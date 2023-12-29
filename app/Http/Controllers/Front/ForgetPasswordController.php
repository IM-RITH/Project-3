<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\PageOtherItem;
use App\Models\Company;
use App\Models\Candidate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ForgetPasswordController extends Controller
{
    public function company_forget_password()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate_dashboard');
        }
        if (Auth::guard('company')->check()) {
            return redirect()->route('company_dashboard');
        }
        $page_other_item = PageOtherItem::where('id', 1)->first();
        return view('front.forget_password_company', compact('page_other_item'));
    }
    public function company_forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $company_data = Company::where('email', $request->email)->first();
        if (!$company_data) {
            return redirect()->back()->with('error', 'Email not found! Relax and try again!');
        }
        // send email to reset password
        $token = hash('sha256', time());
        $company_data->token = $token;
        $company_data->update();


        $reset_link = url('reset-password/company/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please click link below: <br>';
        $message .= '<a href="' . $reset_link . '">Click Here</a>';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('login')->with('success', 'Check your mail!');
    }
    public function company_reset_password($token, $email)
    {
        $company_data = Company::where('token', $token)->where('email', $email)->first();
        if (!$company_data) {
            return redirect()->route('login');
        }
        return view('front.reset_password_company', compact('token', 'email'));
    }
    public function company_reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);
        $company_data = Company::where('token', $request->token)->where('email', $request->email)->first();

        $company_data->password = Hash::make($request->password);
        $company_data->token = '';
        $company_data->update();
        return redirect()->route('login')->with('success', 'Password is reset successfully');
    }

    // candidate
    public function candidate_forget_password()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate_dashboard');
        }
        if (Auth::guard('company')->check()) {
            return redirect()->route('company_dashboard');
        }
        $page_other_item = PageOtherItem::where('id', 1)->first();
        return view('front.forget_password_candidate', compact('page_other_item'));
    }
    public function candidate_forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $candidate_data = Candidate::where('email', $request->email)->first();
        if (!$candidate_data) {
            return redirect()->back()->with('error', 'Email not found! Relax and try again!');
        }
        // send email to reset password
        $token = hash('sha256', time());
        $candidate_data->token = $token;
        $candidate_data->update();


        $reset_link = url('reset-password/candidate/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please click link below: <br>';
        $message .= '<a href="' . $reset_link . '">Click Here</a>';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('login')->with('success', 'Check your mail!');
    }
    public function candidate_reset_password($token, $email)
    {
        $candidate_data = Candidate::where('token', $token)->where('email', $email)->first();
        if (!$candidate_data) {
            return redirect()->route('login');
        }
        return view('front.reset_password_candidate', compact('token', 'email'));
    }
    public function candidate_reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);
        $candidate_data = Candidate::where('token', $request->token)->where('email', $request->email)->first();

        $candidate_data->password = Hash::make($request->password);
        $candidate_data->token = '';
        $candidate_data->update();
        return redirect()->route('login')->with('success', 'Password is reset successfully');
    }
}