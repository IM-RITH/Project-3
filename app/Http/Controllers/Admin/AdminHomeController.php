<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\Company;

class AdminHomeController extends Controller
{
    public function index()
    {
        $jobs = Job::count();
        $companies = Company::where('status', 1)->count();
        $candidates = Candidate::where('status', 1)->count();
        return view("admin.home", compact('jobs', 'companies', 'candidates'));
    }
}
