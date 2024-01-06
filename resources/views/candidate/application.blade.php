@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/blackbanner1.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Applied Jobs</h2>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <td>Cover Letter</td>
                                    <th>Status</th>
                                </tr>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($applied_job as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ optional($item->rJob)->title }}
                                        </td>

                                        <td>
                                            {{ optional(optional($item->rJob)->rCompany)->company_name }}

                                        </td>
                                        <td>
                                            <a href="" class="btn btn-warning"data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $i }}">Cover Letter</a>
                                        </td>
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
                                            <div class="badge bg-{{ $color }}">
                                                {{ $item->status }}
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Cover Letter</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
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
@endsection
