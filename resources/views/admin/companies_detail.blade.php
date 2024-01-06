@extends('admin.layout.app')
@section('heading', 'Companies Detail')

@section('button')
    <div>
        <a href="{{ route('admin_companies') }}" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>
    </div>
@endsection
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Company Information</h5>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th class="w_200">Company Logo</th>
                                <td>    
                                    <img src="{{ asset('uploads/'.$companies_detail->logo) }}" class="w_100" alt="">
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Name</th>
                                <td>{{ $companies_detail->company_name }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Person Name</th>
                                <td>{{ $companies_detail->person_name }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Username</th>
                                <td>{{ $companies_detail->username }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Email</th>
                                <td>{{ $companies_detail->email }}</td>
                            </tr>
                             <tr>
                                <th class="w_200">Phone</th>
                                <td>{{ $companies_detail->phone }}</td>
                            </tr>
                             <tr>
                                <th class="w_200">Address</th>
                                <td>{{ $companies_detail->address }}</td>
                            </tr>
                             <tr>
                                <th class="w_200">Industry</th>
                                <td>{{ optional(optional($companies_detail)->rCompanyIndustry)->name}}</td>
                            </tr>
                             <tr>
                                <th class="w_200">Location</th>
                                <td>{{ optional(optional($companies_detail)->rCompanyLocation)->name }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Size</th>
                                <td>{{ optional(optional($companies_detail)->rCompanySize)->name }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Founded on</th>
                                <td>{{ $companies_detail->founded_on }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Website</th>
                                <td>{{ $companies_detail->website }}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Description</th>
                                <td>{!! $companies_detail->description !!}</td>
                            </tr>
                            <tr>
                                <th class="w_200">Company Map</th>
                                <td>{!! $companies_detail->map_code !!}</td>
                            </tr>
                        </table>
                      </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
