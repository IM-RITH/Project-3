@extends('front.layout.app')


@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/listingbg.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Company Listing</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="job-result">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="job-filter">
                        <form action="{{ url('company-listing') }}" method="get">
                            <div class="widget">
                                <h2>Company Name</h2>
                                <input type="text" name="name" class="form-control" placeholder="Search Company..."
                                    value="{{ $form_name }}" />
                            </div>

                            <div class="widget">
                                <h2>Company Industry</h2>
                                <select name="industry" class="form-control select2">
                                    <option value="">Company Industry</option>
                                    @foreach ($company_industries as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_industry == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Company Location</h2>
                                <select name="location" class="form-control select2">
                                    <option value="">Company Location</option>
                                    @foreach ($company_locations as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_location == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Company Size</h2>
                                <select name="size" class="form-control select2">
                                    <option value="">Company Size</option>
                                    @foreach ($company_sizes as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($form_size == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="widget">
                                <h2>Founded on</h2>
                                <select name="founded" class="form-control select2">
                                    <option value="">Founded on</option>
                                    @for ($i = 1900; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}"
                                            @if ($form_founded == $item->id) selected @endif>{{ $i }}
                                        </option>
                                    @endfor
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
                                        Result for Company Listing
                                    </div>
                                </div>
                                @if (!$companies->count())
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h4 style="text-align: center">No Company Found</h4>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($companies as $item)
                                        <div class="col-md-12">
                                            <div class="item d-flex justify-content-start">
                                                <div class="logo">
                                                    <img src="
                                                 @if ($item->logo != null) {{ asset('uploads/' . $item->logo) }}
                                                  @else
                                                  {{ asset('front/images/logo.png') }} @endif
                                                "
                                                        alt="" />
                                                </div>
                                                <div class="text">
                                                    <h3>
                                                        <a href="{{ route('company', $item->id) }}">
                                                            {{ $item->company_name }}
                                                        </a>
                                                    </h3>
                                                    <div class="detail-1 d-flex justify-content-start">
                                                        <div class="category">
                                                              {{ optional($item->rCompanyIndustry)->name }}
                                                        </div>
                                                        <div class="location">
                                                               {{ optional($item->rCompanyLocation)->name }}
                                                        </div>
                                                    </div>
                                                    <div class="detail-2 d-flex justify-content-start">
                                                    @php
                                                    $new_str = substr($item->description, 0, 250).' ...';
                                                    @endphp
                                                    {!! $new_str !!}
                                                    </div>
                                                    <div class="open-position">
                                                        <span class="badge bg-primary">{{ $item->r_job_count }} Open Positions</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        {{ $companies->appends($_GET)->links() }}
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
