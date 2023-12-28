<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;


class AdminHomePageController extends Controller
{

    public function index()
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        return view('admin.home_page', compact('home_page_data'));
    }

    public function update(Request $request)
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        // validation for update form
        $request->validate([
            'heading' => 'required',
            'job_title' => 'required',
            'job_category' => 'required',
            'job_location' => 'required',
            'search' => 'required',
            'job_category_main_heading' => 'required',
            'job_category_status' => 'required',
            'why_choose_heading' => 'required',
            'why_choose_status' => 'required',
            'feature_jobs_heading' => 'required',
            'feature_jobs_status' => 'required'
        ]);
        // upload image file
        if ($request->hasFile('background')) {
            $request->validate([
                'background' => 'required|mimes:jpg,jpeg,png,gif',
            ]);
            unlink(public_path('uploads/' . $home_page_data->background));
            $ext = $request->file('background')->extension();
            $final_name = 'home_banner' . '.' . $ext;
            $request->file('background')->move(public_path('uploads/'), $final_name);
            // update image to database
            $home_page_data->background = $final_name;
        }


        if ($request->hasFile('why_choose_background')) {
            $request->validate([
                'why_choose_background' => 'required|mimes:jpg,jpeg,png,gif',
            ]);

            // Delete the old file
            unlink(public_path('uploads/' . $home_page_data->why_choose_background));

            // Get the extension of the 'why_choose_background' file
            $ext1 = $request->file('why_choose_background')->extension();

            // Create the new file name
            $final_name1 = 'why_choose_home_background' . '.' . $ext1;

            // Move the file to the public uploads directory
            $request->file('why_choose_background')->move(public_path('uploads/'), $final_name1);

            // Update the image name in the database
            $home_page_data->why_choose_background = $final_name1;
        }


        $home_page_data->heading = $request->heading;
        $home_page_data->text = $request->text;
        $home_page_data->job_title = $request->job_title;
        $home_page_data->job_category = $request->job_category;
        $home_page_data->job_location = $request->job_location;
        $home_page_data->search = $request->search;
        $home_page_data->job_category_main_heading = $request->job_category_main_heading;
        $home_page_data->job_bcategory_sub_heading = $request->job_bcategory_sub_heading;
        $home_page_data->job_category_status = $request->job_category_status;

        $home_page_data->why_choose_heading = $request->why_choose_heading;
        $home_page_data->why_choose_subheading = $request->why_choose_subheading;
        $home_page_data->why_choose_status = $request->why_choose_status;

        $home_page_data->feature_jobs_heading = $request->feature_jobs_heading;
        $home_page_data->feature_jobs_subheading = $request->feature_jobs_subheading;
        $home_page_data->feature_jobs_status = $request->feature_jobs_status;

        $home_page_data->title = $request->title;
        $home_page_data->meta_description = $request->meta_description;
        $home_page_data->update();
        return redirect()->back()->with('success', ' Information Updated Successfully');
    }
}
