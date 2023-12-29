@extends('front.layout.app')

{{-- @section('seo_title') Company @endsection
@section('seo_meta_description') {{ $page_faq_item-> meta_description }} @endsection --}}

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Orders</h2>
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
                    <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>SL</th>
                                        <th>Order No</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>Expire Date</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->order_no }}</td>
                                        <td>{{ $item->rPackage->package_name }}</td>
                                        <td>${{ $item->paid_amount }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->expire_date }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>
                                            @if($item->currently_active == 1)
                                            <span class="badge bg-success"
                                                >Active</span
                                            >
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
