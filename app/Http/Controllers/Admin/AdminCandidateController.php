<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateApplication;
use App\Models\CandidateEducation;
use App\Models\CandidateSkill;
use App\Models\CandidateWorkExperience;
use App\Models\CandidateResume;
use App\Models\Job;
use App\Models\Company;
use App\Models\Order;

class AdminCandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::where('status', 1)->get();;
        return view('admin.candidates', compact('candidates'));
    }
    public function candidates_detail($id)
    {
        $candidate_single = Candidate::where('id', $id)->first();
        $candidate_education = CandidateEducation::where('candidate_id', $id)->get();
        $candidate_experience = CandidateWorkExperience::where('candidate_id', $id)->get();
        $candidate_skill = CandidateSkill::where('candidate_id', $id)->get();
        $candidate_resume = CandidateResume::where('candidate_id', $id)->get();
        return view('admin.candidates_detail', compact('candidate_single', 'candidate_education', 'candidate_experience', 'candidate_skill', 'candidate_resume'));
    }
    public function candidates_applied_job($id)
    {
        $applicants = CandidateApplication::with('rJob')->where('candidate_id', $id)->get();
        return view('admin.candidates_applied_job', compact('applicants'));
    }
    public function delete($id)
    {
        CandidateApplication::where('candidate_id', $id)->delete();
        CandidateEducation::where('candidate_id', $id)->delete();
        CandidateWorkExperience::where('candidate_id', $id)->delete();
        CandidateSkill::where('candidate_id', $id)->delete();

        $resume_data = CandidateResume::where('candidate_id', $id)->get();
        foreach ($resume_data as $item) {
            unlink(public_path('uploads/' . $item->file));
        }
        CandidateResume::where('candidate_id', $id)->delete();
        $candidate_data = Candidate::where('id', $id)->first();

        if ($candidate_data->photo != null) {
            unlink(public_path('uploads/' . $candidate_data->photo));
        }

        Candidate::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Candidate deleted successfully');
    }
}
