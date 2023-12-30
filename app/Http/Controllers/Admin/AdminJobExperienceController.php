<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobExperience;

class AdminJobExperienceController extends Controller
{
    public function index()
    {
        $job_experiences = JobExperience::get();
        return view('admin.job_experience', compact('job_experiences'));
    }
    public function add_section()
    {
        return view('admin.job_experience_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_experience = new JobExperience();
        $job_experience->name = $request->name;

        $job_experience->save();
        return redirect()->route('admin_job_experience')->with('success', 'Job Experience Added Successfully');
    }
    public function edit($id)
    {
        $single_job_experience = JobExperience::find($id);

        return view('admin.job_experience_edit', compact('single_job_experience'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_experience = JobExperience::find($id);
        $job_experience->name = $request->name;
        $job_experience->update();
        return redirect()->route('admin_job_experience')->with('success', 'Job Experience Updated Successfully');
    }
    public function delete($id)
    {
        $job_experience = JobExperience::find($id);
        $job_experience->delete();
        return redirect()->route('admin_job_experience')->with('success', 'Job Experience Deleted Successfully');
    }
}
