@extends('front.layout.app')

@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/company.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Resume of {{ $candidate_single->name }}</h2>
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
                    <h4 class="resume">Basic Profile</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th class="w-200">Photo:</th>
                                <td>
                                    @if ($candidate_single->photo == '')
                                        <img src="{{ asset('front/images/_candidate_photo.jpg') }}" class="w-100"
                                            alt="">
                                    @elseif ($candidate_single->photo != '')
                                        <img src="{{ asset('uploads/' . $candidate_single->photo) }}" class="w-100"
                                            alt="">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    {{ $candidate_single->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Designation:</th>
                                <td>
                                    {{ $candidate_single->designation }}
                                </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    {{ $candidate_single->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>
                                    {{ $candidate_single->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th>Country:</th>
                                <td>
                                    {{ $candidate_single->country }}
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    {{ $candidate_single->address }}
                                </td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>
                                    {{ $candidate_single->state }}
                                </td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td>
                                    {{ $candidate_single->city }}
                                </td>
                            </tr>
                            <tr>
                                <th>Zip Code:</th>
                                <td>
                                    {{ $candidate_single->zip_code }}
                                </td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>
                                    {{ $candidate_single->gender }}
                                </td>
                            </tr>
                            <tr>
                                <th>Marital Status:</th>
                                <td>
                                    {{ $candidate_single->marital_status }}
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>
                                    {{ $candidate_single->date_of_birth }}
                                </td>
                            </tr>
                            <tr>
                                <th>Website:</th>
                                <td>
                                    {{ $candidate_single->website }}
                                </td>
                            </tr>
                            <tr>
                                <th>Biography:</th>
                                <td>
                                    {!! $candidate_single->biography !!}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Education</h4>

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
                                    <td>{{ $loop -> iteration }}</td>
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

                    <h4 class="resume mt-5">Skills</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Skill Name</th>
                                    <th>Percentage</th>
                                </tr>
                                @foreach ($candidate_skill as $skill)
                                <tr>
                                     <td>{{ $loop -> iteration }}</td>
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

                    <h4 class="resume mt-5">Experience</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Company</th>
                                    <th>Designation</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                                @foreach ( $candidate_experience as $exp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $exp->company }}
                                    </td>
                                    <td>
                                        {{ $exp->designation }}
                                    </td>
                                    <td>
                                        {{ $exp->start_date }}
                                    </td>
                                    <td>
                                        {{ $exp->end_date }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="resume mt-5">Resume</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>File</th>
                                </tr>
                                @foreach ( $candidate_resume as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $res->name }}
                                    </td>
                                    <td>
                                        <a href="{{ asset('uploads/candidate_resume/'.$res->file) }}" target="_blank">
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
@endsection
