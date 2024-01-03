@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/blackbanner1.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add Your Work Experiences Here</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('candidate.slidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <a href="{{ route('candidate_work_experience') }}" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> See
                        All</a>
                    <form action="{{ route('candidate_work_experience_store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Company Name</label>
                                <div class="form-group">
                                    <input type="text" name="company" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Designation</label>
                                <div class="form-group">
                                    <input type="text" name="designation" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Start Date</label>
                                <div class="form-group">
                                    <input type="text" name="start_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">End Date</label>
                                <div class="form-group">
                                    <input type="text" name="end_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Add" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
