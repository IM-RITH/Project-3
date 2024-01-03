@extends('front.layout.app')
@section('seo_title')
    {{ $home_page_data->title }}
@endsection
@section('seo_meta_description')
    {{ $home_page_data->meta_description }}
@endsection
@section('main_content')
    <div class="slider" style="background-image: url({{ asset('uploads/' . $home_page_data->background) }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item">
                        <div class="text">
                            <h2>{{ $home_page_data->heading }}</h2>
                            <p>
                                {{ $home_page_data->text }}
                            </p>
                        </div>
                        <div class="search-section">
                            <form action="{{ url('job-listing') }}" method="get">
                                @csrf
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="{{ $home_page_data->job_title }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="category" class="form-select select2">
                                                    <option value="{{ $home_page_data->job_category }}">
                                                        Job Category
                                                    </option>
                                                    @foreach ($all_job_categories as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select name="location" class="form-select select2">
                                                    <option value="{{ $home_page_data->job_location }}">
                                                        Job Location
                                                    </option>
                                                    @foreach ($all_job_locations as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="hidden" name="type">
                                            <input type="hidden" name="experience">
                                            <input type="hidden" name="gender">
                                            <input type="hidden" name="salary_range">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                                {{ $home_page_data->search }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($home_page_data->job_category_status == 'Show')
        <div class="job-category">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $home_page_data->job_category_main_heading }}</h2>
                            <p>
                                {{ $home_page_data->job_bcategory_sub_heading }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($job_categories as $item)
                        <div class="col-md-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                                <h3>{{ $item->name }}</h3>
                                <p>({{ $item->r_job_count }} Open Positions)</p>
                                <a href="{{ url('job-listing?category=' . $item->id) }}"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="all">
                            <a href="{{ route('job_categories') }}" class="btn btn-primary">See All Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($home_page_data->why_choose_status == 'Show')
        <div class="why-choose"
            style="background-image: url({{ asset('uploads/' . $home_page_data->why_choose_background) }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $home_page_data->why_choose_heading }}</h2>
                            <p>
                                {{ $home_page_data->why_choose_subheading }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($why_choose_item as $item)
                        <div class="col-md-4">
                            <div class="inner">
                                <div class="icon">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $item->heading }}</h2>
                                    <p>
                                        {!! nl2br($item->text) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($home_page_data->feature_jobs_status == 'Show')
        <div class="job">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{ $home_page_data->feature_jobs_heading }}</h2>
                            <p>{{ $home_page_data->feature_jobs_subheading }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($featured_jobs as $item)
                        @php
                            $this_company_id = $item->rCompany->id;
                            $order_data = \App\Models\Order::where('company_id', $this_company_id)
                                ->where('currently_active', 1)
                                ->first();
                            if (date('Y-m-d') > $order_data->expire_date) {
                                continue;
                            }
                            $i++;
                            if ($i > 4) {
                                break;
                            }
                        @endphp
                        <div class="col-lg-6 col-md-12">
                            <div class="item d-flex justify-content-start">
                                <div class="logo">
                                    <img src="
                                        @if (optional($item->rCompany)->logo != null) {{ asset('uploads/' . optional($item->rCompany)->logo) }}
                                        @else
                                        {{ asset('front/images/logo.png') }} @endif
                                        "
                                        alt="" />
                                </div>
                                <div class="text">
                                    <h3>
                                        <a href="{{ route('job', $item->id) }}"> {{ optional($item)->title }},
                                            {{ optional($item->rCompany)->company_name }}</a>
                                    </h3>
                                    <div class="detail-1 d-flex justify-content-start">
                                        <div class="category"> {{ $item->rJobCategory->name }}</div>
                                        <div class="location"> {{ $item->rJobLocation->name }}</div>
                                    </div>
                                    <div class="detail-2 d-flex justify-content-start">
                                        <div class="date">{{ $item->created_at->diffForHumans() }}</div>
                                        <div class="budget"> {{ $item->rJobSalaryRange->name }}</div>
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
                                        <div class="type">{{ $item->rJobType->name }}</div>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="all">
                            <a href="{{ route('job_listing') }}" class="btn btn-primary">See All Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- our happy client --}}
    {{-- <div class="testimonial" style="background-image: url({{ asset('uploads/banner11.jpg') }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Our Happy Clients</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel owl-carousel">
                        <div class="item">
                            <div class="photo">
                                <img src="{{ asset('uploads/t1.jpg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h4>Robert Krol</h4>
                                <p>CEO, ABC Company</p>
                            </div>
                            <div class="description">
                                <p>
                                    Lorem ipsum dolor sit amet, an labores
                                    explicari qui, eu nostrum copiosae
                                    argumentum has. Latine propriae quo no,
                                    unum ridens. Lorem ipsum dolor sit amet,
                                    an labores explicari qui, eu nostrum
                                    copiosae argumentum has. Latine propriae
                                    quo no, unum ridens.
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="photo">
                                <img src="{{ asset('uploads/t2.jpg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h4>Sal Harvey</h4>
                                <p>Director, DEF Company</p>
                            </div>
                            <div class="description">
                                <p>
                                    Lorem ipsum dolor sit amet, an labores
                                    explicari qui, eu nostrum copiosae
                                    argumentum has. Latine propriae quo no,
                                    unum ridens. Lorem ipsum dolor sit amet,
                                    an labores explicari qui, eu nostrum
                                    copiosae argumentum has. Latine propriae
                                    quo no, unum ridens.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- blog section --}}
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Latest News</h2>
                        <p>
                            Check our latest news from the following section
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('uploads/twitter.jpg') }}" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">Twitter violated contract by failing to pay millions in bonuses, US
                                    judge rules</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    WASHINGTON, Dec 22 (Reuters) - Twitter violated contracts by failing to pay millions of
                                    dollars in bonuses that the social media company, now called X Corp, had promised its
                                    employees, a federal judge ruled on Friday.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('uploads/news2.jpg') }}" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">Israel grants Intel $3.2 billion for new $25 billion chip plant</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    JERUSALEM, Dec 26 - Israel's government agreed to give Intel (INTC.O) a $3.2 billion
                                    grant for a new $25 billion chip plant it plans to build in southern Israel, both sides
                                    said on Tuesday, in what is the largest investment ever by a company in Israel.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('uploads/chatgpt.jpg') }}" alt="" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="post.html">A year after ChatGPT’s release, the AI revolution is just beginning</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    New York
                                    CNN -
                                    ChatGPT may not be able to perform a cake smash on its first birthday today, but it
                                    certainly managed to wow the world and create a mess of hope, hype and chaos
                                    through nearly all parts of the economy in the past year.
                                </p>
                            </div>
                            <div class="button">
                                <a href="post.html" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
