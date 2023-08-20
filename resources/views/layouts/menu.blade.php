<li class="nav-item">
    <a href="{{ route('students.index') }}"
       class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
        <p>@lang('message.students')</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('subjects.index') }}"
       class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
        <p>@lang('message.subjects')</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('studentSubjects.index') }}"
       class="nav-link {{ Request::is('studentSubjects*') ? 'active' : '' }}">
        <p>@lang('message.studentGrades')</p>
    </a>
</li>




