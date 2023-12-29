@extends('front.layout.app')

{{-- @section('seo_title') Company @endsection
@section('seo_meta_description') {{ $page_faq_item-> meta_description }} @endsection --}}

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Payment</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('company.slidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <h4>Current Plan</h4>
                    <div class="row box-items mb-4">
                        <div class="col-md-4">
                            <div class="box1">
                                @if ($currently_plan == null)
                                    <span class="text-danger">No plan is available</span>
                                @else
                                    <h4>${{ $currently_plan->rPackage->package_price }}</h4>
                                    <p>{{ $currently_plan->rPackage->package_name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h4>Upgrade Plan (Make Payment)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <form action="{{ route('paypal') }}" method="post">
                                @csrf
                            <tr>
                                <td class="w-200">
                                    <select name="package_id" class="form-control select2">
                                        @foreach ($packages as $item)
                                            <option value="{{ $item->id }}">{{ $item->package_name }}
                                                (${{ $item->package_price }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                   <button type="submit" class="btn btn-primary">Pay with PayPal</button>
                                </td>
                            </tr>
                        </form>
                            <tr>
                                <form action="{{ route('company_stripe') }}" method="post">
                                    @csrf
                                <td><select name="package_id" class="form-control select2">
                                        @foreach ($packages as $item)
                                            <option value="{{ $item->id }}">{{ $item->package_name }}
                                                (${{ $item->package_price }})</option>
                                        @endforeach
                                    </select></td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Pay with Stripe</button>
                                </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
