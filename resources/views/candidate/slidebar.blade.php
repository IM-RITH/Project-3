<ul class="list-group list-group-flush">
    <li class="list-group-item active  {{ Request::is('candidate/dashboard') ? 'active':'' }}">
        <a href="{{ route('candidate_dashboard') }}">Dashboard</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-applied-jobs.html">Applied Jobs</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-bookmarked-jobs.html">Bookmarked Jobs</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/education/view') ? 'active':'' }}">
        <a href="{{ route('candidate_education') }}">Education</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-skill.html">Skills</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-experience.html">Work Experience</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-award.html">Awards</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/edit-profile') ? 'active':'' }}">
        <a href="{{ route('candidate_edit_profile') }}">Edit Profile</a>
    </li>
    <li class="list-group-item">
        <a href="candidate-resume.html">Resume Upload</a>
    </li>
    <li class="list-group-item {{ Request::is('candidate/change-password') ? 'active':'' }}">
        <a href="{{ route('candidate_change_password') }}">Change Password</a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('candidate_logout') }}">Logout</a>
    </li>
</ul>
