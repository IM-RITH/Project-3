<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyIndustry;

class AdminCompanyIndustryController extends Controller
{
    public function index()
    {
        $job_company_industries = CompanyIndustry::get();
        return view('admin.job_company_industry', compact('job_company_industries'));
    }
    public function add_section()
    {
        return view('admin.job_company_industry_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_industry = new CompanyIndustry();
        $job_company_industry->name = $request->name;

        $job_company_industry->save();
        return redirect()->route('admin_job_company_industry')->with('success', 'Company Industry Added Successfully');
    }
    public function edit($id)
    {
        $single_job_company_industry = CompanyIndustry::find($id);

        return view('admin.job_company_industry_edit', compact('single_job_company_industry'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $job_company_industry = CompanyIndustry::find($id);
        $job_company_industry->name = $request->name;
        $job_company_industry->update();
        return redirect()->route('admin_job_company_industry')->with('success', 'Company Industry Updated Successfully');
    }
    public function delete($id)
    {
        $job_company_industry = CompanyIndustry::find($id);
        $job_company_industry->delete();
        return redirect()->route('admin_job_company_industry')->with('success', 'Company Industry Deleted Successfully');
    }
}
