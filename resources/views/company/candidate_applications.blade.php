@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/company.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Candidate Applications</h2>
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

                    <h4>All Job Post</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Job Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Is Feature?</th>
                                    <td>Job Detail</td>
                                    <td>Applicants</td>
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
                                            <a href="{{ route('job', $item->id) }}" class="badge bg-primary">Detail</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('company_applicants', $item->id) }}" class="badge bg-primary">Applicants</a>
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
