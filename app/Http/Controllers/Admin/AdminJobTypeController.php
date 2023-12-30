<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobType;

class AdminJobTypeController extends Controller
{
    public function index()
    {
        $job_types = JobType::get();
        return view('admin.job_type', compact('job_types'));
    }
    public function add_section()
    {
        return view('admin.job_type_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_types = new JobType();
        $job_types->name = $request->name;

        $job_types->save();
        return redirect()->route('admin_job_type')->with('success', 'Job Type Added Successfully');
    }
    public function edit($id)
    {
        $single_job_type = JobType::find($id);

        return view('admin.job_type_edit', compact('single_job_type'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_type = JobType::find($id);
        $job_type->name = $request->name;
        $job_type->update();
        return redirect()->route('admin_job_type')->with('success', 'Job Type Updated Successfully');
    }
    public function delete($id)
    {
        $job_type = JobType::find($id);
        $job_type->delete();
        return redirect()->route('admin_job_type')->with('success', 'Job Type Deleted Successfully');
    }
}
