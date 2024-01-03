@extends('front.layout.app')

@section('main_content')
    <div class="page-top page-top-job-single page-top-company-single"
        style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 job job-single">
                    <div class="item d-flex justify-content-start">
                        <div class="logo">
                            <img src="
                                @if ($company_single->logo != null) {{ asset('uploads/' . $company_single->logo) }}
                                @else
                                {{ asset('front/images/logo.png') }} @endif
                                "
                                alt="" />
                        </div>
                        <div class="text">
                            <h3>
                                {{ $company_single->company_name }}
                            </h3>
                            <div class="detail-1 d-flex justify-content-start">
                                <div class="category">
                                    {{ optional($company_single->rCompanyIndustry)->name }}
                                </div>
                                <div class="location">
                                    {{ optional($company_single->rCompanyLocation)->name }}
                                </div>
                                <div class="email">
                                    {{ $company_single->email }}
                                </div>
                                @if ($company_single->phone != null)
                                    <div class="phone">
                                        {{ $company_single->phone }}
                                    </div>
                                @endif

                            </div>
                            <div class="special">
                                <div class="type">
                                    {{ $company_single->r_job_count }} Open Positions
                                </div>
                                @if (
                                    $company_single->facebook != null ||
                                        $company_single->Twitter != null ||
                                        $company_single->instagram != null ||
                                        $company_single->linkedIn != null)
                                    <div class="social">
                                        <ul>
                                            @if ($company_single->facebook != null)
                                                <li>
                                                    <a href="
                                                 {{ $company_single->facebook }}
                                                "
                                                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                            @endif
                                            @if ($company_single->Twitter != null)
                                                <li>
                                                    <a
                                                        href="
                                                 {{ $company_single->Twitter }} 
                                                "target="_blank"><i
                                                            class="fab fa-twitter"></i></a>
                                                </li>
                                            @endif
                                            @if ($company_single->linkedIn != null)
                                                <li>
                                                    <a
                                                        href="
                                                 {{ $company_single->linkedIn }}
                                                "target="_blank"><i
                                                            class="fab fa-linkedin-in"></i></a>
                                                </li>
                                            @endif

                                            @if ($company_single->instagram != null)
                                                <li>
                                                    <a
                                                        href="
                                                 {{ $company_single->instagram }}
                                                "target="_blank"><i
                                                            class="fab fa-instagram"></i></a>
                                                </li>
                                            @endif
                                        </ul>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            About Company
                        </h2>
                        <p>
                            {!! $company_single->description !!}
                        </p>
                    </div>
                    @if (
                        $company_single->oh_mon != null ||
                            $company_single->oh_tues != null ||
                            $company_single->oh_wed != null ||
                            $company_single->oh_thurs != null ||
                            $company_single->oh_fri != null ||
                            $company_single->oh_sat != null ||
                            $company_single->oh_sun != null)
                        <div class="left-item">
                            <h2>
                                <i class="fas fa-file-invoice"></i>
                                Opening Hours
                            </h2>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Monday</td>
                                            <td>
                                                {{ $company_single->oh_mon }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tuesday</td>
                                            <td>
                                                {{ $company_single->oh_tues }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wednesday</td>
                                            <td>
                                                {{ $company_single->oh_wed }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <td>
                                                {{ $company_single->oh_thu }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <td>
                                                {{ $company_single->oh_fri }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Saturday</td>
                                            <td>
                                                {{ $company_single->oh_sat }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sunday</td>
                                            <td>
                                                {{ $company_single->oh_sun }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if ($company_photo != '')
                        <div class="left-item">
                            <h2>
                                <i class="fas fa-file-invoice"></i>
                                Photos
                            </h2>
                            <div class="photo-all">
                                <div class="row">
                                    @foreach ($company_photo as $item)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a href="{{ asset('uploads/' . $item->photo) }}" class="magnific">
                                                    <img src="{{ asset('uploads/' . $item->photo) }}" alt="" />
                                                    <div class="icon">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($company_video != '')
                        <div class="left-item">
                            <h2>
                                <i class="fas fa-file-invoice"></i>
                                Videos
                            </h2>
                            <div class="video-all">
                                <div class="row">
                                    @foreach ($company_video as $item)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a class="video-button"
                                                    href="http://www.youtube.com/watch?v={{ $item->video_id }}">
                                                    <img src="http://img.youtube.com/vi/{{ $item->video_id }}/0.jpg"
                                                        alt="" />
                                                    <div class="icon">
                                                        <i class="far fa-play-circle"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="left-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Open Positions
                        </h2>
                        <div class="job related-job pt-0 pb-0">
                            <div class="container">
                                <div class="row">
                                    @foreach ($jobs as $item)
                                        <div class="col-md-12">
                                            <div class="item d-flex justify-content-start">
                                                <div class="logo">
                                                    <img src=" {{ asset('uploads/' . $company_single->logo) }}"
                                                        alt="" />
                                                </div>
                                                <div class="text">
                                                    <h3>
                                                        <a href="{{ route('job', $item->id) }}">
                                                            {{ optional($item)->title }}
                                                            {{ $company_single->company_name }}
                                                        </a>
                                                    </h3>
                                                    <div class="detail-1 d-flex justify-content-start">
                                                        <div class="category">
                                                            {{ optional($item->rJobCategory)->name }}
                                                        </div>
                                                        <div class="location">
                                                            {{ optional($item->rJobLocation)->name }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Company Overview
                        </h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><b> Contact Person</b></td>
                                        <td>
                                            {{ $company_single->person_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b> Category</b></td>
                                        <td>
                                            {{ optional($company_single->rCompanyIndustry)->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>
                                            {{ $company_single->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td>
                                            {{ $company_single->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td>
                                            {{ $company_single->address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Website</b></td>
                                        <td>
                                            {{ $company_single->website }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Company Size</b>
                                        </td>
                                        <td>
                                            {{ optional($company_single->rCompanySize)->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Founded On</b>
                                        </td>
                                        <td>
                                            {{ $company_single->founded_on }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($company_single->map_code != null)
                        <div class="right-item">
                            <h2>
                                <i class="fas fa-file-invoice"></i>
                                Location Map
                            </h2>
                            <div class="location-map">
                                {!! $company_single->map_code !!}
                            </div>
                        </div>
                    @endif
                    {{-- <div class="right-item">
                        <h2>
                            <i class="fas fa-file-invoice"></i>
                            Contact Company
                        </h2>
                        <div class="enquery-form">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Phone Number" />
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control h-150" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
