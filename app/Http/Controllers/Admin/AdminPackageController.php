<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class AdminPackageController extends Controller
{
    public function index()
    {
        $package = Package::get();
        return view('admin.package', compact('package'));
    }
    public function add_section()
    {
        return view('admin.package_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required',
            'package_price' => 'required',
            'package_days' => 'required',
            'package_display_time' => 'required',
            'total_allowed_jobs' => 'required',
            'total_allowed_feaured_jobs' => 'required',
            'total_allowed_photos' => 'required',
            'total_allowed_videos' => 'required',
        ]);
        $obj = new Package();
        $obj->package_name = $request->package_name;
        $obj->package_price = $request->package_price;
        $obj->package_days = $request->package_days;
        $obj->package_display_time = $request->package_display_time;
        $obj->total_allowed_jobs = $request->total_allowed_jobs;
        $obj->total_allowed_feaured_jobs = $request->total_allowed_feaured_jobs;
        $obj->total_allowed_photos = $request->total_allowed_photos;
        $obj->total_allowed_videos = $request->total_allowed_videos;
        $obj->save();
        return redirect()->route('admin_package')->with('success', 'Package Added Successfully');
    }
    public function edit($id)
    {
        $single_package = Package::find($id);

        return view('admin.package_edit', compact('single_package'));
    }
    public function update(Request $request, $id)
    {
        $obj = Package::find($id);
        $request->validate([
            'package_name' => 'required',
            'package_price' => 'required',
            'package_days' => 'required',
            'package_display_time' => 'required',
            'total_allowed_jobs' => 'required',
            'total_allowed_feaured_jobs' => 'required',
            'total_allowed_photos' => 'required',
            'total_allowed_videos' => 'required',
        ]);

        $obj->package_name = $request->package_name;
        $obj->package_price = $request->package_price;
        $obj->package_days = $request->package_days;
        $obj->package_display_time = $request->package_display_time;
        $obj->total_allowed_jobs = $request->total_allowed_jobs;
        $obj->total_allowed_feaured_jobs = $request->total_allowed_feaured_jobs;
        $obj->total_allowed_photos = $request->total_allowed_photos;
        $obj->total_allowed_videos = $request->total_allowed_videos;
        $obj->update();
        return redirect()->route('admin_package')->with('success', 'Package Updated Successfully');
    }
    // delete function
    public function delete($id)
    {
        $obj = Package::find($id);
        $obj->delete();
        return redirect()->route('admin_package')->with('success', 'Package Deleted Successfully');
    }
}
