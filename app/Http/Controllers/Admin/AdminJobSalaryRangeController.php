<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSalaryRange;

class AdminJobSalaryRangeController extends Controller
{

    public function index()
    {
        $job_salary_ranges = JobSalaryRange::get();
        return view('admin.job_salary', compact('job_salary_ranges'));
    }
    public function add_section()
    {
        return view('admin.job_salary_range_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_salary_range = new JobSalaryRange();
        $job_salary_range->name = $request->name;

        $job_salary_range->save();
        return redirect()->route('admin_job_salary_range')->with('success', 'Salary Range Added Successfully');
    }
    public function edit($id)
    {
        $single_job_salary_range = JobSalaryRange::find($id);

        return view('admin.job_salary_range_edit', compact('single_job_salary_range'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_salary_range = JobSalaryRange::find($id);
        $job_salary_range->name = $request->name;
        $job_salary_range->update();
        return redirect()->route('admin_job_salary_range')->with('success', 'Salary Range Updated Successfully');
    }
    public function delete($id)
    {
        $job_salary_range = JobSalaryRange::find($id);
        $job_salary_range->delete();
        return redirect()->route('admin_job_salary_range')->with('success', 'Salary Range Deleted Successfully');
    }
}
