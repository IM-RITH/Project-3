@extends('admin.layout.app')
@section('heading', 'Home Page Content')
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_home_page_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row custom-tab">
                                <div class="col-lg-3 col-md-12">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-1" type="button" role="tab"
                                            aria-controls="v-pills-1" aria-selected="true">Search</button>
                                        <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-2" type="button" role="tab"
                                            aria-controls="v-pills-2" aria-selected="false">Job Category</button>
                                        <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-3" type="button" role="tab"
                                            aria-controls="v-pills-3" aria-selected="false">Why Choose Us</button>
                                        <button class="nav-link" id="v-pills-4-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-4" type="button" role="tab"
                                            aria-controls="v-pills-4" aria-selected="false">Feature jobs</button>
                                        <button class="nav-link" id="v-pills-5-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-5" type="button" role="tab"
                                            aria-controls="v-pills-5" aria-selected="false">SEO Section</button>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                            aria-labelledby="v-pills-1-tab" tabindex="0">
                                            {{-- Search section --}}
                                            <div class="row">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Heading *</label>
                                                        <input type="text" class="form-control" name="heading"
                                                            value="{{ $home_page_data->heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Text</label>
                                                        <textarea name="text" class="form-control h_100" cols="30" rows="10">{{ $home_page_data->text }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-label">Job Title *</label>
                                                                <input type="text" class="form-control" name="job_title"
                                                                    value="{{ $home_page_data->job_title }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-label">Job Location *</label>
                                                                <input type="text" class="form-control"
                                                                    name="job_location"
                                                                    value="{{ $home_page_data->job_location }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-label">Job Category *</label>
                                                                <input type="text" class="form-control"
                                                                    name="job_category"
                                                                    value="{{ $home_page_data->job_category }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mb-4">
                                                                <label class="form-label">Search *</label>
                                                                <input type="text" class="form-control" name="search"
                                                                    value="{{ $home_page_data->search }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Existing Background *</label>
                                                        <div>
                                                            <img src="{{ asset('uploads/' . $home_page_data->background) }}"
                                                                alt="" class="w_300">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Change Background *</label>
                                                        <div>
                                                            <input type="file" class="form-control mt_10"
                                                                name="background">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                            aria-labelledby="v-pills-2-tab" tabindex="0">
                                            {{-- Category section --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="job_category_main_heading"
                                                            value="{{ $home_page_data->job_category_main_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Sub Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="job_bcategory_sub_heading"
                                                            value="{{ $home_page_data->job_bcategory_sub_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Job Status *</label>
                                                        <select name="job_category_status" class="form-control">
                                                            <option value="Show"
                                                                @if ($home_page_data->job_category_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->job_category_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- why choose us section --}}
                                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                            aria-labelledby="v-pills-3-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="why_choose_heading"
                                                            value="{{ $home_page_data->why_choose_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Sub Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="why_choose_subheading"
                                                            value="{{ $home_page_data->why_choose_subheading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Existing Background *</label>
                                                        <div>
                                                            <img src="{{ asset('uploads/' . $home_page_data->why_choose_background) }}"
                                                                alt="" class="w_300">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Change Background *</label>
                                                        <div>
                                                            <input type="file" class="form-control mt_10"
                                                                name="why_choose_background">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Status *</label>
                                                        <select name="why_choose_status" class="form-control">
                                                            <option value="Show"
                                                                @if ($home_page_data->why_choose_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->why_choose_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- feature jobs section --}}
                                        <div class="tab-pane fade" id="v-pills-4" role="tabpanel"
                                            aria-labelledby="v-pills-4-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="feature_jobs_heading"
                                                            value="{{ $home_page_data->feature_jobs_heading }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Sub Heading *</label>
                                                        <input type="text" class="form-control"
                                                            name="feature_jobs_subheading"
                                                            value="{{ $home_page_data->feature_jobs_subheading }}">
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="form-label">Status *</label>
                                                        <select name="feature_jobs_status" class="form-control">
                                                            <option value="Show"
                                                                @if ($home_page_data->feature_jobs_status == 'Show') selected @endif>Show
                                                            </option>
                                                            <option value="Hide"
                                                                @if ($home_page_data->feature_jobs_status == 'Hide') selected @endif>Hide
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- SEO Section --}}
                                        <div class="tab-pane fade" id="v-pills-5" role="tabpanel"
                                            aria-labelledby="v-pills-5-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title"
                                                            value="{{ $home_page_data->title }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Meta Description</label>
                                                        <textarea name="meta_description" class="form-control" cols="30" rows="10">{{ $home_page_data->meta_description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
