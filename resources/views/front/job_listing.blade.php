@extends('front.layout.app')


@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/listingbg.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Job Listing</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="job-filter">
                        <form action="{{ url('job-listing') }}" method="get">
                            <div class="widget">
                                <h2>Job Title</h2>
                                <input type="text" name="title" class="form-control" placeholder="Search Titles ..."
                                    value="{{ $form_title }}" />
                            </div>

                            <div class="widget">
                                <h2>Job Category</h2>
                                <select name="category" class="form-control select2">
                                    <option value="">Job Category</option>
                                    @foreach ($job_categories as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_category == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Job Location</h2>
                                <select name="location" class="form-control select2">
                                    <option value="">Job Location</option>
                                    @foreach ($job_locations as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_location == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Job Type</h2>
                                <select name="type" class="form-control select2">
                                    <option value="">Job Type</option>
                                    @foreach ($job_types as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_type == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Experience</h2>
                                <select name="experience" class="form-control select2">
                                    <option value="">Experience</option>
                                    @foreach ($job_experiences as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_experience == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Gender</h2>
                                <select name="gender" class="form-control select2">
                                    <option value="">Gender</option>
                                    @foreach ($job_genders as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_gender == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Salary Range</h2>
                                <select name="salary_range" class="form-control select2">
                                    <option value="">Salary Range</option>
                                    @foreach ($job_salary_ranges as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_salary_range == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-button">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Filter
                                </button>
                            </div>
                        </form>

                        <div class="advertisement">
                            <a href=""><img src="uploads/ad-2.png" alt="" /></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="job">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-result-header">
                                        <i class="fas fa-search"></i> Search
                                        Result for Job Listing
                                    </div>
                                </div>
                                @if (!$jobs->count())
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h4 style="text-align: center">No Job Found</h4>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($jobs as $item)
                                        @php
                                            $this_company_id = $item->rCompany->id;
                                            $order_data = \App\Models\Order::where('company_id', $this_company_id)
                                                ->where('currently_active', 1)
                                                ->first();
                                            if (date('Y-m-d') > $order_data->expire_date) {
                                                continue;
                                            }
                                        @endphp
                                        <div class="col-md-12">
                                            <div class="item d-flex justify-content-start">
                                                <div class="logo">
                                                    <img src="
                                                 @if ($item->rCompany->logo != null) {{ asset('uploads/' . $item->rCompany->logo) }}
                                                  @else
                                                  {{ asset('front/images/logo.png') }} @endif
                                                "
                                                        alt="" />
                                                </div>
                                                <div class="text">
                                                    <h3>
                                                        <a href="{{ route('job', $item->id) }}">
                                                            {{ $item->title }},
                                                            {{ $item->rCompany->company_name }}
                                                        </a>
                                                    </h3>
                                                    <div class="detail-1 d-flex justify-content-start">
                                                        <div class="category">
                                                            {{ $item->rJobCategory->name }}
                                                        </div>
                                                        <div class="location">
                                                            {{ $item->rJobLocation->name }}
                                                        </div>
                                                    </div>
                                                    <div class="detail-2 d-flex justify-content-start">
                                                        <div class="date">
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </div>
                                                        <div class="budget">
                                                            {{ $item->rJobSalaryRange->name }}
                                                        </div>
                                                        @if (date('Y-m-d') > $item->deadline)
                                                            <div class="expired">
                                                                Expired
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="special d-flex justify-content-start">
                                                        @if ($item->is_featured == 1)
                                                            <div class="featured">
                                                                Featured
                                                            </div>
                                                        @elseif ($item->is_featured == 0)
                                                            <div class="featured">
                                                                Not Featured
                                                            </div>
                                                        @endif
                                                        <div class="type">
                                                            {{ $item->rJobType->name }}
                                                        </div>
                                                        @if ($item->is_urgent == 1)
                                                            <div class="urgent">
                                                                Urgent
                                                            </div>
                                                        @elseif ($item->is_urgent == 0)
                                                            <div class="urgent">
                                                                Not Urgent
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="bookmark">
                                                        <a href=""><i class="fas fa-bookmark active"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        {{ $jobs->appends($_GET)->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
