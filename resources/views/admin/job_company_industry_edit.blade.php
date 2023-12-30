@extends('admin.layout.app')
@section('heading', 'Edit Company Industry')

@section('button')
    <div>
        <a href="{{ route('admin_job_company_industry') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
    </div>
@endsection
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_job_company_industry_update', $single_job_company_industry->id) }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $single_job_company_industry->name }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
