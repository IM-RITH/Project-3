<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CandidateApplication;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Package;
use App\Models\CompanyLocation;
use App\Models\CompanyIndustry;
use App\Models\CompanySize;
use App\Models\Company;
use App\Models\CompanyPhoto;
use App\Models\CompanyVideo;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\JobType;
use App\Models\JobGender;
use App\Models\JobSalaryRange;
use App\Models\JobExperience;
use App\Models\Job;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateResume;
use App\Models\CandidateSkill;
use App\Models\CandidateWorkExperience;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use function PHPUnit\Framework\returnValue;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $job_open = Job::where('company_id', Auth::guard('company')->user()->id)->count();
        $job_featured = Job::where('company_id', Auth::guard('company')->user()->id)->where('is_featured', 1)->count();
        $jobs = Job::with('rJobCategory', 'rJobType')->where('company_id', Auth::guard('company')->user()->id)->orderBy('id', 'desc')->take(3)->get();
        return view('company.dashboard', compact('jobs', 'job_open', 'job_featured'));
    }
    public function orders()
    {
        $orders = Order::with('rPackage')
            ->orderBy('id', 'desc')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->get();
        $packages = Package::get();
        return view('company.orders', compact('orders'));
    }
    public function make_payment()
    {
        $currently_plan = Order::with('rPackage')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();
        $packages = Package::get();
        return view('company.make_payment', compact('currently_plan', 'packages'));
    }

    public function company_stripe(Request $request)
    {
        $single_package_data = Package::where('id', $request->package_id)->first();
        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $single_package_data->package_name,
                        ],
                        'unit_amount' => $single_package_data->package_price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe_success'),
            'cancel_url' => route('stripe_cancel'),
        ]);

        session()->put('package_id', $single_package_data->id);
        session()->put('package_price', $single_package_data->package_price);
        session()->put('package_days', $single_package_data->package_days);
        return redirect()->away($response->url);
    }
    public function stripe_success()
    {
        $data['currently_active'] = 0;
        Order::where('company_id', Auth::guard()->user()->id)->update($data);

        $obj = new Order();
        $obj->company_id = Auth::guard()->user()->id;
        $obj->package_id = session()->get('package_id');
        $obj->order_no = time();
        $obj->paid_amount = session()->get('package_price');
        $obj->payment_method = 'Stripe';
        $obj->start_date = date('Y-m-d');
        $days = session()->get('package_days');
        $obj->expire_date = date('Y-m-d', strtotime("+$days days"));
        $obj->currently_active = 1;
        $obj->save();

        session()->forget('package_id');
        session()->forget('package_price');
        session()->forget('package_days');
        return redirect()
            ->route('company_make_payment')
            ->with('success', 'Payment is successfully.');
    }
    public function stripe_cancel()
    {
        return redirect()
            ->route('company_make_payment')
            ->with('error', 'Payment is cancelled.');
    }

    public function edit_profile()
    {
        $company_locations = CompanyLocation::orderBy('name', 'asc')->get();
        $company_industries = CompanyIndustry::orderBy('name', 'asc')->get();
        $company_sizes = CompanySize::get();
        return view('company.edit_profile', compact('company_locations', 'company_industries', 'company_sizes'));
    }
    public function edit_profile_update(Request $request)
    {
        $obj = Company::where('id', Auth::guard('company')->user()->id)->first();
        $id = $obj->id;
        $request->validate([
            'company_name' => 'required',
            'person_name' => 'required',
            'username' => ['required', 'alpha_dash', Rule::unique('companies')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('companies')->ignore($id)],
        ]);
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'required|mimes:jpg,jpeg,png,gif',
            ]);
            if (Auth::guard('company')->user()->logo != '') {
                unlink(public_path('uploads/' . $obj->logo));
            }

            $ext = $request->file('logo')->extension();
            $final_name = 'company_logo' . time() . '.' . $ext;
            $request->file('logo')->move(public_path('uploads/'), $final_name);
            $obj->logo = $final_name;
        }
        $obj->company_name = $request->company_name;
        $obj->person_name = $request->person_name;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->address = $request->address;
        $obj->company_location_id = $request->company_location_id;
        $obj->company_industry_id = $request->company_industry_id;
        $obj->company_size_id = $request->company_size_id;
        $obj->founded_on = $request->founded_on;
        $obj->website = $request->website;
        $obj->description = $request->description;
        $obj->oh_mon = $request->oh_mon;
        $obj->oh_tues = $request->oh_tues;
        $obj->oh_wed = $request->oh_wed;
        $obj->oh_thu = $request->oh_thu;
        $obj->oh_fri = $request->oh_fri;
        $obj->oh_sat = $request->oh_sat;
        $obj->oh_sun = $request->oh_sun;
        $obj->map_code = $request->map_code;
        $obj->facebook = $request->facebook;
        $obj->Twitter = $request->Twitter;
        $obj->linkedIn = $request->linkedIn;
        $obj->instagram = $request->instagram;
        $obj->update();

        return redirect()
            ->back()
            ->with('success', 'Profile is update successfully');
    }

    public function photos()
    {
        // fetch order data to know allow pics to post
        // check if company buy a package
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();

        // check company buy the package yet
        if (!$order_data) {
            return redirect()
                ->back()
                ->with('error', 'You must buy a package first and then the system will allow you to access this section');
        }
        $package_data = Package::where('id', $order_data->package_id)->first();
        if ($package_data->total_allowed_photos == 0) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to access this section!');
        }
        $photos = CompanyPhoto::where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.photo', compact('photos'));
    }
    public function company_photo_submit(Request $request)
    {
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();
        $package_data = Package::where('id', $order_data->package_id)->first();
        $existing_photo_number = CompanyPhoto::where('company_id', Auth::guard('company')->user()->id)->count();

        if ($package_data->total_allowed_photos == $existing_photo_number) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to post anymore!');
        }
        if (date('Y-m-d') > $order_data->expire_date) {
            return redirect()
                ->back()
                ->with('error', 'Your current package has expired!');
        }

        $request->validate([
            'photo' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        $obj = new CompanyPhoto();
        $ext = $request->file('photo')->extension();
        $final_name = 'company_photo_' . time() . '.' . $ext;
        $request->file('photo')->move(public_path('uploads/'), $final_name);
        $obj->photo = $final_name;
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->save();
        return redirect()
            ->back()
            ->with('success', 'Photos is saved successfully');
    }

    public function delete_photos($id)
    {
        $single_photo = CompanyPhoto::where('id', $id)->first();
        unlink(public_path('uploads/' . $single_photo->photo));
        CompanyPhoto::where('id', $id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Photo is deleted Successfully');
    }
    public function videos()
    {
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();

        // check company buy the package yet
        if (!$order_data) {
            return redirect()
                ->back()
                ->with('error', 'You must buy a package first and then the system will allow you to access this section');
        }
        $package_data = Package::where('id', $order_data->package_id)->first();
        if ($package_data->total_allowed_videos == 0) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to access this section!');
        }
        $videos = CompanyVideo::where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.video', compact('videos'));
    }
    public function company_video_submit(Request $request)
    {
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();
        $package_data = Package::where('id', $order_data->package_id)->first();
        $existing_video_number = CompanyVideo::where('company_id', Auth::guard('company')->user()->id)->count();

        if ($package_data->total_allowed_videos == $existing_video_number) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to post anymore!');
        }
        if (date('Y-m-d') > $order_data->expire_date) {
            return redirect()
                ->back()
                ->with('error', 'Your current package has expired!');
        }

        $request->validate([
            'video_id' => 'required',
        ]);
        $obj = new CompanyVideo();
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->video_id = $request->video_id;
        $obj->save();
        return redirect()
            ->back()
            ->with('success', 'Video is saved successfully');
    }
    public function delete_videos($id)
    {
        CompanyVideo::where('id', $id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Video is deleted Successfully');
    }

    public function company_change_password()
    {
        return view('company.change_password');
    }
    public function company_change_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);
        $obj = Company::where('id', Auth::guard('company')->user()->id)->first();
        $obj->password = Hash::make($request->password);
        $obj->update();
        return redirect()
            ->back()
            ->with('success', 'Password is changed successfully');
    }

    // jobs
    public function jobs_create()
    {
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();

        // check company buy the package yet
        if (!$order_data) {
            return redirect()
                ->back()
                ->with('error', 'You must buy a package first and then the system will allow you to access this section');
        }

        if (date('Y-m-d') > $order_data->expire_date) {
            return redirect()
                ->back()
                ->with('error', 'Your current package has expired!');
        }
        $package_data = Package::where('id', $order_data->package_id)->first();
        if ($package_data->total_allowed_jobs == 0) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to access this section!');
        }

        // count job for per company
        $total_job_posted = Job::where('company_id', Auth::guard('company')->user()->id)->count();

        if ($package_data->total_allowed_jobs == $total_job_posted) {
            return redirect()
                ->back()
                ->with('error', 'Your current package does not allow to post anymore!');
        }

        $job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $job_types = JobType::orderBy('name', 'asc')->get();
        $job_experiences = JobExperience::orderBy('id', 'asc')->get();
        $job_genders = JobGender::orderBy('id', 'asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('id', 'asc')->get();
        return view('company.job_create', compact('job_categories', 'job_locations', 'job_types', 'job_experiences', 'job_genders', 'job_salary_ranges'));
    }
    public function jobs_create_submit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'vacancy' => 'required',
        ]);
        $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
            ->where('currently_active', 1)
            ->first();

        $package_data = Package::where('id', $order_data->package_id)->first();

        // $total_featured_job_posted = Job::where('company_id', Auth::guard('company')->user()->id)->count();
        $total_featured_job_posted = Job::where('company_id', Auth::guard('company')->user()->id)
            ->where('is_featured', 1)
            ->count();


        // not yet xu ly
        // if ($total_featured_job_posted >= $package_data->total_allowed_featured_jobs) {
        //     if ($request->is_featured == 1) {
        //         return redirect()
        //             ->back()
        //             ->with('error', 'You aleady have added the total number of featured jobs!');
        //     }
        // }

        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'deadline' => 'required',
        //     'vacancy' => 'required',
        // ]);

        // // Retrieve the active order for the company
        // $order_data = Order::where('company_id', Auth::guard('company')->user()->id)
        //     ->where('currently_active', 1)
        //     ->firstOrFail(); // Using firstOrFail() to ensure an order is found, or throw an exception

        // // Retrieve the package data from the active order
        // $package_data = Package::findOrFail($order_data->package_id); // Using findOrFail() to ensure a package is found

        // // Count the total featured job posts by the company
        // $total_featured_job_posted = Job::where('company_id', Auth::guard('company')->user()->id)
        //     ->where('is_featured', 1)
        //     ->count();

        // // Check if the company has reached the limit of featured job posts
        // if (
        //     $request->has('is_featured') && $request->is_featured == 1 && $total_featured_job_posted >= $package_data->total_allowed_featured_jobs
        // ) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'You have already added the total number of featured jobs allowed for your plan.');
        // }

        $obj = new Job();
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->map_code = $request->map_code;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->save();
        return redirect()
            ->back()
            ->with('success', 'Job Posted successfully');
    }
    public function jobs()
    {
        $jobs = Job::with('rJobCategory', 'rJobType')->where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.jobs', compact('jobs'));
    }
    public function edit_jobs($id)
    {
        $jobs_single = Job::where('id', $id)->first();
        $job_categories = JobCategory::orderBy('name', 'asc')->get();
        $job_locations = JobLocation::orderBy('name', 'asc')->get();
        $job_types = JobType::orderBy('name', 'asc')->get();
        $job_experiences = JobExperience::orderBy('id', 'asc')->get();
        $job_genders = JobGender::orderBy('id', 'asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('id', 'asc')->get();
        return view('company.job_edit', compact('jobs_single', 'job_categories', 'job_locations', 'job_types', 'job_experiences', 'job_genders', 'job_salary_ranges'));
    }
    public function jobs_update(Request $request, $id)
    {
        $obj = Job::where('id', $id)->first();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'vacancy' => 'required',
        ]);
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->map_code = $request->map_code;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->update();
        return redirect()
            ->back()
            ->with('success', 'Job Updated successfully');
    }
    public function jobs_delete($id)
    {
        Job::find($id)->delete();
        return redirect()->route('company_jobs')->with('success', 'Job Deleted Successfully');
    }
    public function candidate_applications()
    {
        $jobs = Job::with('rJobCategory', 'rJobLocation', 'rJobType', 'rJobGender', 'rJobExperience', 'rJobSalaryRange')->where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.candidate_applications', compact('jobs'));
    }

    public function applicants($id)
    {
        $applicants = CandidateApplication::with('rCandidate')->where('job_id', $id)->get();
        $job_single = Job::where('id', $id)->first();
        return view('company.applicants', compact('applicants', 'job_single'));
    }
    public function applicant_resume($id)
    {
        $candidate_single = Candidate::where('id', $id)->first();
        $candidate_education = CandidateEducation::where('candidate_id', $id)->get();
        $candidate_skill = CandidateSkill::where('candidate_id', $id)->get();
        $candidate_experience = CandidateWorkExperience::where('candidate_id', $id)->get();
        $candidate_resume = CandidateResume::where('candidate_id', $id)->get();
        return view('company.applicant_resume', compact('candidate_single', 'candidate_education', 'candidate_skill', 'candidate_experience', 'candidate_resume'));
    }
    public function applicant_status(Request $request)
    {
        $obj = CandidateApplication::where('candidate_id', $request->candidate_id)->where('job_id', $request->job_id)->first();
        $obj->status = $request->status;
        $obj->update();
        return redirect()->back()->with('success', 'Applicant status updated successfully');
    }
}
