<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    public function dashboard()
    {
        return view('candidate.dashboard');
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
        $obj =  CandidateEducation::where('id', $id)->first();
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
        $obj =  CandidateSkill::where('id', $id)->first();
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
}