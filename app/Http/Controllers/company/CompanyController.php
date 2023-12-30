<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Package;
use App\Models\CompanyLocation;
use App\Models\CompanyIndustry;
use App\Models\CompanySize;
use App\Models\Company;
use App\Models\CompanyPhoto;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use function PHPUnit\Framework\returnValue;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('company.dashboard');
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
            $final_name = 'company_logo' . '.' . $ext;
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
}
