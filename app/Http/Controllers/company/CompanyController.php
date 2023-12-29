<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Package;
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
        $orders = Order::with('rPackage')->orderBy('id','desc')->where('company_id', Auth::guard('company')->user()->id)->get();
        $packages = Package::get();
        return view('company.orders', compact('orders'));
    }
    public function make_payment()
    {
        $currently_plan = Order::with('rPackage')->where('company_id', Auth::guard('company')->user()->id)->where('currently_active', 1)->first();
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
                            'name' =>
                            $single_package_data->package_name
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
        $obj->start_date = date("Y-m-d");
        $days = session()->get('package_days');
        $obj->expire_date = date('Y-m-d', strtotime("+$days days"));
        $obj->currently_active = 1;
        $obj->save();

        session()->forget('package_id');
        session()->forget('package_price');
        session()->forget('package_days');
        return redirect()->route('company_make_payment')->with('success', 'Payment is successfully.');
    }
    public function stripe_cancel()
    {
        return redirect()->route('company_make_payment')->with('error', 'Payment is cancelled.');
    }
}