<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\PageHomeItem;
use App\Models\WhyChooseItem;
use App\Models\JobLocation;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        $home_page_data = PageHomeItem::where('id', 1)->first();
        $job_categories = JobCategory::withCount('rJob')->orderBy('r_job_count', 'desc')
            ->take(9)
            ->get(); // show only 9 jobs on front-end
        $all_job_categories = JobCategory::orderBy('name', 'asc')->get();
        $all_job_locations = JobLocation::orderBy('name', 'asc')->get();
        $why_choose_item = WhyChooseItem::get();
        $featured_jobs = Job::with('rCompany', 'rJobCategory', 'rJobLocation', 'rJobType', 'rJobSalaryRange', 'rJobExperience', 'rJobGender')->orderBy('id', 'desc')->where('is_featured', 1)->get();
        return view('front.home', compact('home_page_data', 'job_categories', 'why_choose_item', 'all_job_locations', 'all_job_categories', 'featured_jobs'));
    }
}