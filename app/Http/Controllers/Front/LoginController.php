<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;
use App\Models\Company;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('candidate')->check()) {
            return redirect()->route('candidate_dashboard');
        }
        if (Auth::guard('company')->check()) {
            return redirect()->route('company_dashboard');
        }
        $page_other_item = PageOtherItem::where('id', 1)->first();
        return view('front.login', compact('page_other_item'));
    }
    public function company_login_submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Retrieve the company by username
        $company = Company::where('username', $request->username)->first();

        // Check if the company exists and the password is correct
        if ($company && Hash::check($request->password, $company->password)) {
            // Check if the company's email is verified
            if ($company->status == 0) {
                return redirect()->route('login')->with('error', 'Please verify your email before logging in.');
            }

            // Proceed with login
            Auth::guard('company')->login($company);
            return redirect()->route('company_dashboard');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');

        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);

        // $credentials = [
        //     'username' => $request->username,
        //     'password' => $request->password,
        // ];

        // if (Auth::guard('company')->attempt($credentials)) {
        //     return redirect()->route('company_dashboard');
        // } else {
        //     return redirect()->route('login')->with('error', 'Information is not correct!');
        // }
    }
    public function company_logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('login');
    }

    // candidate login
    public function candidate_login_submit(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Retrieve the candidate by username
        $candidate = Candidate::where('username', $request->username)->first();

        // Check if the candidate exists and the password is correct
        if ($candidate && Hash::check($request->password, $candidate->password)) {
            // Check if the candidate's email is verified
            if ($candidate->status == 0) {
                return redirect()->route('login')->with('error', 'Please verify your email before logging in.');
            }

            // Proceed with login
            Auth::guard('candidate')->login($candidate);
            return redirect()->route('candidate_dashboard');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');

        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);

        // $credentials = [
        //     'username' => $request->username,
        //     'password' => $request->password,
        // ];

        // if (Auth::guard('candidate')->attempt($credentials)) {
        //     return redirect()->route('candidate_dashboard');
        // } else {
        //     return redirect()->route('login')->with('error', 'Information is not correct!');
        // }
    }
    public function candidate_logout()
    {
        Auth::guard('candidate')->logout();
        return redirect()->route('login');
    }
}
