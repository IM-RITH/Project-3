@extends('admin.layout.app')
@section('heading', 'Add Package')

@section('button')
    <div>
        <a href="{{ route('admin_package') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
    </div>
@endsection
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_package_item_store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Package Name</label>
                                        <input type="text" class="form-control" name="package_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Package Price</label>
                                        <input type="text" class="form-control" name="package_price">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Number of Days</label>
                                        <input type="text" class="form-control" name="package_days">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Time</label>
                                        <input type="text" class="form-control" name="package_display_time">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Total Allow Jobs</label>
                                        <input type="text" class="form-control" name="total_allowed_jobs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Total Allow Feature Jobs</label>
                                        <input type="text" class="form-control" name="total_allowed_feaured_jobs">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Total Allow Photos</label>
                                        <input type="text" class="form-control" name="total_allowed_photos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Total Allow Videos</label>
                                        <input type="text" class="form-control" name="total_allowed_videos">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
