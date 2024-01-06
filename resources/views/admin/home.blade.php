@extends('admin.layout.app')
@section('heading', 'Dashboard')

@section('main_content')
    
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Companies</h4>
                                </div>
                                <div class="card-body">
                                    {{ $companies }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Candidates</h4>
                                </div>
                                <div class="card-body">
                                    {{ $candidates }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Jobs</h4>
                                </div>
                                <div class="card-body">
                                    {{ $jobs }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection