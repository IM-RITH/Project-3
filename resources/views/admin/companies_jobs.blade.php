@extends('admin.layout.app')

@section('heading')
    Jobs of <span style="color:#FFB534 ;">{{ $companies_detail->company_name }}</span> Company
@endsection
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Job Title</th>
                                        <td>Category</td>
                                        <td>Location</td>
                                        <td>Is Featured</td>
                                        <td>Job Detail</td>
                                        <th>Applicant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies_jobs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->rJobCategory->name }}</td>
                                            <td>{{ $item->rJobLocation->name }}</td>
                                            <td>

                                                @if ($item->is_featured == 1)
                                                    <span class="badge bg-success">Featured</span>
                                                @else
                                                    <span class="badge bg-danger">Normal</span>
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                 <a href="{{ route('job', $item->id) }}" class="badge bg-primary">Detail</a>
                                            </td>
                                             <td>
                                                <a href="{{ route('admin_companies_applicants',$item->id) }}" class="badge bg-primary">Applicants</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
