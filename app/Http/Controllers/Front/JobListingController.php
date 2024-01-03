<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobType;
use App\Models\JobExperience;
use App\Models\JobGender;
use App\Models\JobSalaryRange;


class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $job_types = JobType::orderBy('name', 'asc')->get();
        $job_experiences = JobExperience::orderBy('id', 'asc')->get();
        $job_genders = JobGender::orderBy('id', 'asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('id', 'asc')->get();
        $form_title = $request->title;
        $form_category = $request->category;
        $form_location = $request->location;
        $form_type = $request->type;
        $form_experience = $request->experience;
        $form_gender = $request->gender;
        $form_salary_range = $request->salary_range;

        $jobs = Job::with('rCompany', 'rJobCategory', 'rJobLocation', 'rJobType', 'rJobSalaryRange')->orderBy('id', 'desc');
        if ($request->title != null) {
            $jobs = $jobs->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->category != null) {
            $jobs = $jobs->where('job_category_id', $request->category);
        }
        if ($request->location != null) {
            $jobs = $jobs->where('job_location_id', $request->location);
        }
        if ($request->type != null) {
            $jobs = $jobs->where('job_type_id', $request->type);
        }
        if ($request->experience != null) {
            $jobs = $jobs->where('job_experience_id', $request->experience);
        }
        if ($request->gender != null) {
            $jobs = $jobs->where('job_gender_id', $request->gender);
        }
        if ($request->salary_range != null) {
            $jobs = $jobs->where('job_salary_range_id', $request->salary_range);
        }

        $jobs = $jobs->paginate(3);
        $jobs = $jobs->appends($request->all());
        return view('front.job_listing', compact('jobs', 'job_categories', 'job_locations', 'job_types', 'job_experiences', 'job_genders', 'job_salary_ranges', 'form_title', 'form_category', 'form_location', 'form_type', 'form_experience', 'form_gender', 'form_salary_range'));
    }
    public function detail($id)
    {
        $job_single = Job::with('rCompany', 'rJobCategory', 'rJobLocation', 'rJobType', 'rJobSalaryRange', 'rJobExperience', 'rJobGender')
            ->where('id', $id)
            ->first();
        $jobs = Job::with('rCompany', 'rJobCategory', 'rJobLocation', 'rJobType', 'rJobSalaryRange', 'rJobExperience', 'rJobGender')->where('job_category_id', $job_single->job_category_id)->get();
        return view('front.job', compact('job_single', 'jobs'));
    }
    public function send_email(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $subject = 'Enquery form job: ' . $request->job_title;
        $message = 'Visitors Info: <br>';
        $message .= 'Name: ' . $request->name . '<br>';
        $message .= 'Email: ' . $request->email . '<br>';
        $message .= 'Phone: ' . $request->phone . '<br>';
        $message .= 'Message: ' . $request->message;
        Mail::to($request->receive_email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Email is sent Successfully!');
    }
}