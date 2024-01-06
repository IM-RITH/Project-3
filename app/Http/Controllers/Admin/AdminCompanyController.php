<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\CandidateWorkExperience;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Job;
use App\Models\CandidateApplication;
use App\Models\CandidateEducation;
use App\Models\CandidateResume;
use App\Models\Order;

class AdminCompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('status', 1)->get();
        return view('admin.companies', compact('companies'));
    }
    public function companies_detail($id)
    {
        $companies_detail = Company::with('rCompanyLocation', 'rCompanyIndustry', 'rCompanySize')
            ->where('id', $id)
            ->first();
        return view('admin.companies_detail', compact('companies_detail'));
    }
    public function companies_jobs($id)
    {
        $companies_detail = Company::where('id', $id)->first();
        $companies_jobs = Job::with('rJobCategory', 'rJobLocation')
            ->where('company_id', $id)
            ->get();
        return view('admin.companies_jobs', compact('companies_jobs', 'companies_detail'));
    }
    public function companies_applicants($id)
    {
        $job_detail = Job::where('id', $id)->first();
        $applicants = CandidateApplication::with('rCandidate')
            ->where('job_id', $id)
            ->get();

        return view('admin.companies_applicants', compact('applicants', 'job_detail'));
    }

    public function companies_applicant_resume($id)
    {
        $candidate_single = Candidate::where('id', $id)->first();
        $candidate_education = CandidateEducation::where('candidate_id', $id)->get();
        $candidate_experience = CandidateWorkExperience::where('candidate_id', $id)->get();
        $candidate_skill = CandidateSkill::where('candidate_id', $id)->get();
        $candidate_resume = CandidateResume::where('candidate_id', $id)->get();
        return view('admin.companies_applicant_resume', compact('candidate_single', 'candidate_education', 'candidate_experience', 'candidate_skill', 'candidate_resume'));
    }
    public function delete($id)
    {

        $job_list = Job::where('company_id', $id)->get();
        foreach ($job_list as $job) {
            CandidateApplication::where('job_id', $job->id)->delete();
        }
        Job::where('company_id', $id)->delete();
        Order::where('company_id', $id)->delete();
        $company_data = Company::where('id', $id)->first();

        if ($company_data->logo != null) {
            unlink(public_path('uploads/' . $company_data->logo));
        }

        Company::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Company deleted successfully');
    }
}
