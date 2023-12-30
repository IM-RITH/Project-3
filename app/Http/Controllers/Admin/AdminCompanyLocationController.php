<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyLocation;

class AdminCompanyLocationController extends Controller
{
    public function index()
    {
        $job_company_locations = CompanyLocation::get();
        return view('admin.job_company_location', compact('job_company_locations'));
    }
    public function add_section()
    {
        return view('admin.job_salary_location_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_location = new CompanyLocation();
        $job_company_location->name = $request->name;

        $job_company_location->save();
        return redirect()->route('admin_job_company_location')->with('success', 'Company Location Added Successfully');
    }
    public function edit($id)
    {
        $single_job_company_location = CompanyLocation::find($id);

        return view('admin.job_company_location_edit', compact('single_job_company_location'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_location = CompanyLocation::find($id);
        $job_company_location->name = $request->name;
        $job_company_location->update();
        return redirect()->route('admin_job_company_location')->with('success', 'Company Location Updated Successfully');
    }
    public function delete($id)
    {
        $job_company_location = CompanyLocation::find($id);
        $job_company_location->delete();
        return redirect()->route('admin_job_company_location')->with('success', 'Company Location Deleted Successfully');
    }
}