@extends('admin.layout.app')
@section('heading', 'Candidate List')

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
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Phone</td>
                                        <td>Detail</td>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                 {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->username }}
                                            </td>
                                            <td>
                                                 {{ $item->email }}
                                            </td>
                                            <td>
                                                 {{ $item->phone }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_candidates_detail', $item->id) }}"
                                                    class="badge bg-primary text-white w-100 mb-1">Detail</a>
                                                    <a href="{{ route('admin_candidates_applied_job', $item->id) }}"
                                                    class="badge bg-primary text-white w-100 mb-1">Applied Job</a>
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_candidates_delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onClick="return confirm('Are you sure?');">Delete</a>
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
