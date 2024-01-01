@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/blackbanner1.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Candidate Skills</h2>
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
                    <a href="{{ route('candidate_skill_add') }}" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i>
                        Add Item</a>
                        @if ( !$skills->count())
                            <div class="text-danger">No Skill Data</div>
                        @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Name Of Skill</th>
                                    <th>Percentage</th>
                                    
                                    <th class="w-100">Action</th>
                                </tr>
                                @foreach ($skills as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->percentage }}</td>
                                    <td>
                                        <a href="{{ route('candidate_skill_edit', $item->id) }}" class="btn btn-warning btn-sm text-white"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('candidate_skill_delete',$item->id) }}" class="btn btn-danger btn-sm"
                                            onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                  @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
