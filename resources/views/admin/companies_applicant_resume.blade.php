@extends('admin.layout.app')
@section('heading', 'Candidate Detail')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Company Information</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="w_200">Profile</th>
                                    <td>
                                        <img src="{{ asset('uploads/' . $candidate_single->photo) }}" class="w_100"
                                            alt="">
                                    </td>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="w_200">Name</th>
                                    <td>{{ $candidate_single->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Designation</th>
                                    <td>{{ $candidate_single->designation }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Username</th>
                                    <td>{{ $candidate_single->username }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Email</th>
                                    <td>{{ $candidate_single->email }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Phone</th>
                                    <td>{{ $candidate_single->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Country</th>
                                    <td>{{ $candidate_single->country }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Address</th>
                                    <td>{{ $candidate_single->address }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">City</th>
                                    <td>{{ $candidate_single->city }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Zip Code</th>
                                    <td>{{ $candidate_single->zip_code }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Gender</th>
                                    <td>{{ $candidate_single->gender }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Martital Status</th>
                                    <td>{{ $candidate_single->marital_status }}</td>
                                </tr>
                                <tr>
                                    <th class="w_200">Date of Birth</th>
                                    <td>{{ $candidate_single->date_of_birth }}</td>
                                </tr>
                            </table>
                        </div>
                        @if ($candidate_education->count())
                            <h5>Education</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>Education Level</th>
                                            <th>Institute</th>
                                            <th>Degree</th>
                                            <th>Passing Year</th>
                                        </tr>
                                        @foreach ($candidate_education as $edu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $edu->level }}
                                                </td>
                                                <td>
                                                    {{ $edu->institute }}
                                                </td>
                                                <td>
                                                    {{ $edu->degree }}
                                                </td>
                                                <td>
                                                    {{ $edu->passing_year }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        @if ($candidate_skill->count())
                            <h5>Skills</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th class="w_200">No.</th>
                                                <th>Skill Name</th>
                                                <th>Percentage</th>
                                            </tr>
                                            @foreach ($candidate_skill as $skill)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $skill->name }}
                                                    </td>
                                                    <td>
                                                        {{ $skill->percentage }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        @endif

                        @if ($candidate_experience->count())
                            <h5>Experience</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="w_200">No.</th>
                                            <th>Company</th>
                                            <th>Designation</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                        @foreach ($candidate_experience as $edu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $edu->company }}
                                                </td>
                                                <td>
                                                    {{ $edu->designation }}
                                                </td>
                                                <td>
                                                    {{ $edu->start_date }}
                                                </td>
                                                <td>
                                                    {{ $edu->end_date }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <h5>Resume</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="w_200">No.</th>
                                        <th>Name</th>
                                        <th>File</th>
                                    </tr>
                                    @foreach ($candidate_resume as $res)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $res->name }}
                                            </td>
                                            <td>
                                                <a href="{{ asset('uploads/candidate_resume/' . $res->file) }}"
                                                    target="_blank">
                                                    {{ $res->file }}
                                                </a>
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
