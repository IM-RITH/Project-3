<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageOtherItem;
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

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('company')->attempt($credentials)) {
            return redirect()->route('company_dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Information is not correct!');
        }
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

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('candidate')->attempt($credentials)) {
            return redirect()->route('candidate_dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Information is not correct!');
        }
    }
    public function candidate_logout()
    {
        Auth::guard('candidate')->logout();
        return redirect()->route('login');
    }
}