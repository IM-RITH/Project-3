@extends('admin.layout.app')

@section('heading')
    Applicants of <span style="color:#FFB534 ;">{{ $job_detail->title }}</span> Job
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
                                        <th>Name</th>
                                        <td>Email</td>
                                        <td>Phone</td>
                                        <td>Status</td>
                                        <td>Detail</td>
                                        <th>Cover Letter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($applicants as $item)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->rCandidate->name }}</td>
                                            <td>{{ $item->rCandidate->email }}</td>
                                            <td>{{ $item->rCandidate->phone }}</td>
                                            <td>
                                                @if ($item->status == 'Applied')
                                                    @php
                                                        $color = 'primary';
                                                    @endphp
                                                @elseif ($item->status == 'Approved')
                                                    @php
                                                        $color = 'success';
                                                    @endphp
                                                @elseif ($item->status == 'Rejected')
                                                    @php
                                                        $color = 'danger';
                                                    @endphp
                                                @endif
                                                <span class="badge bg-{{ $color }}">{{ $item->status }}</span>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_companies_applicant_resume', $item->id)}}"class="badge bg-primary" target="_blank">Detail</a>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-warning"data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $i }}">Cover Letter</a>
                                                <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cover Letter
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $item->cover_letter !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
