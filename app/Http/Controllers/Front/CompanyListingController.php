<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyIndustry;
use App\Models\CompanyLocation;
use App\Models\CompanySize;
use App\Models\CompanyPhoto;
use App\Models\CompanyVideo;
use App\Models\Job;

class CompanyListingController extends Controller
{
    public function index(Request $request)
    {
        $company_industries = CompanyIndustry::orderBy('name', 'asc')->get();
        $company_locations = CompanyLocation::orderBy('name', 'asc')->get();
        $company_sizes = CompanySize::orderBy('id', 'asc')->get();

        $form_name = $request->name;
        $form_industry = $request->industry;
        $form_location = $request->location;
        $form_size = $request->size;
        $form_founded = $request->founded;

        $companies = Company::withCount('rJob')
            ->with('rCompanyIndustry', 'rCompanyLocation', 'rCompanySize')
            ->orderBy('id', 'desc');
        if ($request->name != null) {
            $companies = $companies->where('company_name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->industry != null) {
            $companies = $companies->where('company_industry_id', $request->industry);
        }
        if ($request->location != null) {
            $companies = $companies->where('company_location_id', $request->location);
        }
        if ($request->size != null) {
            $companies = $companies->where('company_size_id', $request->size);
        }
        if ($request->founded != null) {
            $companies = $companies->where('founded_on', $request->founded);
        }

        $companies = $companies->paginate(5);
        return view('front.company_listing', compact('companies', 'company_industries', 'company_locations', 'company_sizes', 'form_name', 'form_industry', 'form_location', 'form_size', 'form_founded'));
    }
    public function detail($id)
    {
        $company_single = Company::withCount('rJob')
            ->with('rCompanyIndustry', 'rCompanyLocation', 'rCompanySize')
            ->first();

        if (CompanyPhoto::where('company_id', $company_single->id)->exists()) {
            $company_photo = CompanyPhoto::where('company_id', $company_single->id)->get();
        } else {
            $company_photo = '';
        }
        if (CompanyVideo::where('company_id', $company_single->id)->exists()) {
            $company_video = CompanyVideo::where('company_id', $company_single->id)->get();
        } else {
            $company_video = '';
        }
        $jobs = Job::with(
            'rJobCategory',
            'rJobLocation',
            'rJobType',
            'rJobExperience',
            'rJobGender',
            'rJobSalaryRange'
        )
            ->where('company_id', $company_single->id)
            ->orderBy('id', 'desc')->get();

        return view('front.company', compact('company_single', 'company_photo', 'company_video', 'jobs'));
    }
}