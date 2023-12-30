<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobGender;

class AdminJobGenderController extends Controller
{
    public function index()
    {
        $job_genders = JobGender::get();
        return view('admin.job_gender', compact('job_genders'));
    }
    public function add_section()
    {
        return view('admin.job_gender_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_gender = new JobGender();
        $job_gender->name = $request->name;

        $job_gender->save();
        return redirect()->route('admin_job_gender')->with('success', 'Gender Added Successfully');
    }
    public function edit($id)
    {
        $single_job_gender = JobGender::find($id);

        return view('admin.job_gender_edit', compact('single_job_gender'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_gender = JobGender::find($id);
        $job_gender->name = $request->name;
        $job_gender->update();
        return redirect()->route('admin_job_gender')->with('success', 'Gender Updated Successfully');
    }
    public function delete($id)
    {
        $job_gender = JobGender::find($id);
        $job_gender->delete();
        return redirect()->route('admin_job_gender')->with('success', 'Gender Deleted Successfully');
    }
}
