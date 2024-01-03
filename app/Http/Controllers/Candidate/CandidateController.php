<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateSkill;
use App\Models\CandidateWorkExperience;
use App\Models\CandidateResume;
use App\Models\Job;
use App\Models\CandidateApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class CandidateController extends Controller
{
    public function dashboard()
    {
        $total_applied_job = 0;
        $total_approved_job = 0;
        $total_rejected_job = 0;

        $total_applied_job = CandidateApplication::where('candidate_id', Auth::guard('candidate')->user()->id)->where('status', 'Applied')->count();
        $total_rejected_job = CandidateApplication::where('candidate_id', Auth::guard('candidate')->user()->id)->where('status', 'Rejected')->count();
        $total_approved_job = CandidateApplication::where('candidate_id', Auth::guard('candidate')->user()->id)->where('status', 'Approved')->count();

        return view('candidate.dashboard', compact('total_applied_job', 'total_rejected_job', 'total_approved_job'));
    }
    public function edit_profile()
    {
        return view('candidate.edit_profile');
    }
    public function edit_profile_update(Request $request)
    {
        $obj = Candidate::where('id', Auth::guard('candidate')->user()->id)->first();
        $id = $obj->id;
        $request->validate([
            'name' => 'required',
            // 'username' => ['required', 'alpha_dash', Rule::unique('candidates')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('candidates')->ignore($id)],
        ]);
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|mimes:jpg,jpeg,png,gif',
            ]);
            if (Auth::guard('candidate')->user()->photo != '') {
                unlink(public_path('uploads/' . $obj->photo));
            }

            $ext = $request->file('photo')->extension();
            $final_name = 'candidate_photo_' . time() . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);
            $obj->photo = $final_name;
        }
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->address = $request->address;
        $obj->biography = $request->biography;
        $obj->country = $request->country;
        $obj->state = $request->state;
        $obj->city = $request->city;
        $obj->website = $request->website;
        $obj->zip_code = $request->zip_code;
        $obj->gender = $request->gender;
        $obj->marital_status = $request->marital_status;
        $obj->date_of_birth = $request->date_of_birth;
        $obj->update();

        return redirect()
            ->back()
            ->with('success', 'Profile is update successfully');
    }
    public function candidate_change_password()
    {
        return view('candidate.change_password');
    }
    public function candidate_change_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);
        $obj = Candidate::where('id', Auth::guard('candidate')->user()->id)->first();
        $obj->password = Hash::make($request->password);
        $obj->update();
        return redirect()
            ->back()
            ->with('success', 'Password is changed successfully');
    }
    // education section
    public function education()
    {
        $educations = CandidateEducation::where('candidate_id', Auth::guard('candidate')->user()->id)->get();
        return view('candidate.education', compact('educations'));
    }

    public function add_section()
    {
        return view('candidate.education_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'institute' => 'required',
            'degree' => 'required',
            'passing_year' => 'required',
        ]);

        $obj = new CandidateEducation();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->level = $request->level;
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->save();
        return redirect()
            ->route('candidate_education')
            ->with('success', 'Your Education is added successfully');
    }
    public function edit($id)
    {
        $education_single = CandidateEducation::where('id', $id)->first();
        return view('candidate.education_edit', compact('education_single'));
    }
    public function update(Request $request, $id)
    {
        $obj = CandidateEducation::where('id', $id)->first();
        $request->validate([
            'level' => 'required',
            'institute' => 'required',
            'degree' => 'required',
            'passing_year' => 'required',
        ]);
        $obj->level = $request->level;
        $obj->institute = $request->institute;
        $obj->degree = $request->degree;
        $obj->passing_year = $request->passing_year;
        $obj->update();
        return redirect()
            ->route('candidate_education')
            ->with('success', 'Your Education is updated successfully');
    }
    public function delete($id)
    {
        CandidateEducation::where('id', $id)->delete();
        return redirect()
            ->route('candidate_education')
            ->with('success', 'Your Education is deleted successfully');
    }

    // candidate skills section
    public function skill()
    {
        $skills = CandidateSkill::where('candidate_id', Auth::guard('candidate')->user()->id)->get();
        return view('candidate.skill', compact('skills'));
    }

    public function skill_add_section()
    {
        return view('candidate.skill_add');
    }
    public function skill_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $obj = new CandidateSkill();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->save();
        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Your Skill is added successfully');
    }
    public function skill_edit($id)
    {
        $skill_single = CandidateSkill::where('id', $id)->first();
        return view('candidate.skill_edit', compact('skill_single'));
    }
    public function skill_update(Request $request, $id)
    {
        $obj = CandidateSkill::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);
        $obj->name = $request->name;
        $obj->percentage = $request->percentage;
        $obj->update();
        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Your SKill is updated successfully');
    }
    public function skill_delete($id)
    {
        CandidateSkill::where('id', $id)->delete();
        return redirect()
            ->route('candidate_skill')
            ->with('success', 'Your Education is deleted successfully');
    }

    // candidate work experience section
    public function work_experience()
    {
        $work_experiences = CandidateWorkExperience::where('candidate_id', Auth::guard('candidate')->user()->id)->get();
        return view('candidate.work_experience', compact('work_experiences'));
    }

    public function work_experience_add_section()
    {
        return view('candidate.work_experience_add');
    }
    public function work_experience_store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $obj = new CandidateWorkExperience();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->save();
        return redirect()
            ->route('candidate_work_experience')
            ->with('success', 'Your Work Experience is added successfully');
    }
    public function work_experience_edit($id)
    {
        $work_experience_single = CandidateWorkExperience::where('id', $id)->first();
        return view('candidate.work_experience_edit', compact('work_experience_single'));
    }
    public function work_experience_update(Request $request, $id)
    {
        $obj = CandidateWorkExperience::where('id', $id)->first();
        $request->validate([
            'company' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $obj->company = $request->company;
        $obj->designation = $request->designation;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->update();
        return redirect()
            ->route('candidate_work_experience')
            ->with('success', 'Your Work Experience is updated successfully');
    }
    public function work_experience_delete($id)
    {
        CandidateWorkExperience::where('id', $id)->delete();
        return redirect()
            ->route('candidate_work_experience')
            ->with('success', 'Your Work Experience is deleted successfully');
    }

    // candidate resume section
    public function resume()
    {
        $resumes = CandidateResume::where('candidate_id', Auth::guard('candidate')->user()->id)->get();
        return view('candidate.resume', compact('resumes'));
    }

    public function resume_add_section()
    {
        return view('candidate.resume_add');
    }
    public function resume_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,docx, doc, xls, xlsx, ppt, pptx',
        ]);
        $ext = $request->file('file')->extension();
        $filename = 'candidate_resume' . time() . '.' . $ext;
        $request->file('file')->move(public_path('uploads/candidate_resume'), $filename);
        $obj = new CandidateResume();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->name = $request->name;
        $obj->file = $filename;
        $obj->save();
        return redirect()
            ->route('candidate_resume')
            ->with('success', 'Your Resume is added successfully');
    }
    public function resume_edit($id)
    {
        $resume_single = CandidateResume::where('id', $id)->first();
        return view('candidate.resume_edit', compact('resume_single'));
    }
    public function resume_update(Request $request, $id)
    {
        $obj = CandidateResume::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,docx, doc, xls, xlsx, ppt, pptx',
        ]);
        $ext = $request->file('file')->extension();
        $filename = 'candidate_resume' . time() . '.' . $ext;
        $request->file('file')->move(public_path('uploads/candidate_resume'), $filename);
        $obj->name = $request->name;
        $obj->file = $filename;
        $obj->update();
        return redirect()
            ->route('candidate_resume')
            ->with('success', 'Your Resume is updated successfully');
    }
    public function resume_delete($id)
    {
        CandidateResume::where('id', $id)->delete();
        return redirect()
            ->route('candidate_resume')
            ->with('success', 'Your Resume is deleted successfully');
    }

    // candidate apply section
    public function apply($id)
    {
        $existing_apply_check = CandidateApplication::where('candidate_id', Auth::guard('candidate')->user()->id)
            ->where('job_id', $id)
            ->count();
        if ($existing_apply_check > 0) {
            return redirect()
                ->back()
                ->with('error', 'You have already applied for this job');
        }
        $job_single = Job::where('id', $id)->first();
        return view('candidate.apply', compact('job_single'));
    }
    public function apply_submit(Request $request, $id)
    {
        $request->validate([
            'cover_letter' => 'required',
        ]);
        $obj = new CandidateApplication();
        $obj->candidate_id = Auth::guard('candidate')->user()->id;
        $obj->job_id = $id;
        $obj->cover_letter = $request->cover_letter;
        $obj->status = 'Applied';
        $obj->save();

        $job_info = Job::with('rCompany')->where('id', $id)->first();
        $company_email = $job_info->rCompany->email;

        // sending email to company
        $link = route('company_applicants', $id);
        $subject = 'Applied Job';
        $message = 'Please check the application link below: <a href="' . $link . '">Click Here</a>';
        Mail::to($company_email)->send(new Websitemail($subject, $message));
        return redirect()
            ->route('job', $id)
            ->with('success', 'You have applied for this job');
    }
    public function application()
    {
        $applied_job = CandidateApplication::with('rJob')->where('candidate_id', Auth::guard('candidate')->user()->id)->get();
        return view('candidate.application',  compact('applied_job'));
    }
}