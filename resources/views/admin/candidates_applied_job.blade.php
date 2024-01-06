@extends('admin.layout.app')
@section('heading', 'Candidate Applied Job')

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
                                        <td>Company</td>
                                        <td>Status</td>
                                        <td>Cover Letter</td>
                                        <td>Detail</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($applicants as $item)
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
                                            <td>
                                                 <a href="{{ route('admin_candidates_detail', $item->id) }}" class="badge bg-primary">Detail</a>    
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
