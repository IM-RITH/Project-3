<ul class="list-group list-group-flush ">
    <li class="list-group-item {{ request()->routeIs('candidate_dashboard') ? 'active' : '' }}">
        <a href="{{ route('candidate_dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item {{ request()->routeIs('candidate_application') ? 'active' : '' }}">
        <a href="{{ route('candidate_application') }}">Applied Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/education/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_education') }}">Education</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/skill/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_skill') }}">Skills</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/work-experience/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_work_experience') }}">Work Experience</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/edit-profile') ? 'active' : '' }}">
        <a href="{{ route('candidate_edit_profile') }}">Edit Profile</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/resume/*') ? 'active' : '' }}">
        <a href="{{ route('candidate_resume') }}">Resume Upload</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/change-password') ? 'active' : '' }}">
        <a href="{{ route('candidate_change_password') }}">Change Password</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('candidate_logout') }}">Logout</a>
    </li>
</ul>
