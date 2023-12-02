<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;


class AdminJobCategoryController extends Controller
{
    public function index()
    {
        $job_category = JobCategory::get();
        return view('admin.job_category', compact('job_category'));
    }
    public function add_section()
    {
        return view('admin.job_category_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);
        $job_category = new JobCategory();
        $job_category->name = $request->name;
        $job_category->icon = $request->icon;
        $job_category->save();
        return redirect()->route('admin_job_category')->with('success', 'Job Category Added Successfully');
    }
    public function edit($id)
    {
        // $single_job_category = JobCategory::where('id', $id)->first();
        $single_job_category = JobCategory::find($id);

        return view('admin.job_category_edit', compact('single_job_category'));
    }
    public function update(Request $request, $id)
    {
        //  $single_job_category = JobCategory::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);
        $job_category = JobCategory::find($id);
        $job_category->name = $request->name;
        $job_category->icon = $request->icon;
        $job_category->update();
        return redirect()->route('admin_job_category')->with('success', 'Job Category Updated Successfully');
    }
    // delete function
    public function delete($id)
    {
        $job_category = JobCategory::find($id);
        $job_category->delete();
        return redirect()->route('admin_job_category')->with('success', 'Job Category Deleted Successfully');
    }
}