@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/blackbanner1.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Jobs</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        @include('company.slidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>SL</th>
                                    <th>Job Title</th>
                                    <th>Job Category</th>
                                    <th>Job Type</th>
                                    <th>Is Feature?</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($jobs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->rJobCategory->name }}</td>
                                         <td>{{ $item->rJobType->name }}</td>
                                        <td>
                                            @if ($item->is_featured == 1)
                                                <span class="badge bg-success">Feature</span>
                                            @else
                                                <span class="badge bg-danger">Normal</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('company_jobs_edit', $item->id) }}" class="btn btn-warning btn-sm text-white"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="{{ route('company_jobs_delete', $item->id) }}" class="btn btn-danger btn-sm"
                                                onClick="return confirm('Are you sure?');"><i
                                                    class="fas fa-trash-alt"></i></a>
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
@endsection
