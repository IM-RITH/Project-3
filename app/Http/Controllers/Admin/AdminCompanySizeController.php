<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySize;

class AdminCompanySizeController extends Controller
{
    public function index()
    {
        $job_company_sizes = CompanySize::get();
        return view('admin.job_company_size', compact('job_company_sizes'));
    }
    public function add_section()
    {
        return view('admin.job_company_size_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_size = new CompanySize();
        $job_company_size->name = $request->name;

        $job_company_size->save();
        return redirect()->route('admin_job_company_size')->with('success', 'Company Size Added Successfully');
    }
    public function edit($id)
    {
        $single_job_company_size = CompanySize::find($id);

        return view('admin.job_company_size_edit', compact('single_job_company_size'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_size = CompanySize::find($id);
        $job_company_size->name = $request->name;
        $job_company_size->update();
        return redirect()->route('admin_job_company_size')->with('success', 'Company Size Updated Successfully');
    }
    public function delete($id)
    {
        $job_company_size  = CompanySize::find($id);
        $job_company_size->delete();
        return redirect()->route('admin_job_company_size')->with('success', 'Company Size Deleted Successfully');
    }
}
