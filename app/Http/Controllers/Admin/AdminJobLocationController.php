<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobLocation;

class AdminJobLocationController extends Controller
{
    public function index()
    {
        $job_locations = JobLocation::get();
        return view('admin.job_location', compact('job_locations'));
    }
    public function add_section()
    {
        return view('admin.job_location_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_location = new JobLocation();
        $job_location->name = $request->name;

        $job_location->save();
        return redirect()->route('admin_job_location')->with('success', 'Job Location Added Successfully');
    }
    public function edit($id)
    {
        $single_job_location = JobLocation::find($id);

        return view('admin.job_location_edit', compact('single_job_location'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_location = JobLocation::find($id);
        $job_location->name = $request->name;
        $job_location->update();
        return redirect()->route('admin_job_location')->with('success', 'Job Location Updated Successfully');
    }
    public function delete($id)
    {
        $job_location = JobLocation::find($id);
        $job_location->delete();
        return redirect()->route('admin_job_location')->with('success', 'Job Location Deleted Successfully');
    }
}
