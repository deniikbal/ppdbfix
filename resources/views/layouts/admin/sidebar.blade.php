<ul class="nav nav-aside">
    <li class="nav-label">Dashboard</li>
    <li class="nav-item @if (request()->routeIs('admin.index')) active @endif "><a href="{{ route('admin.index') }}"
                                                                                   class="nav-link"><i
                    data-feather="shopping-bag"></i>
            <span>Dashboard</span></a></li>

    <li class="nav-label mg-t-25">Pages</li>
    <li class="nav-item @if (request()->routeIs('allstudent')) active @endif"><a href="{{ route('allstudent') }}"
                                                                                 class="nav-link"><i
                    data-feather="users"></i> <span>Student</span></a></li>
    <li class="nav-item @if (request()->routeIs('users.index')) active @endif"><a href="{{ route('users.index') }}"
                                                                                  class="nav-link"><i
                    data-feather="user"></i>
            <span>User Management</span></a></li>
    <li class="nav-item @if (request()->routeIs('schools.index')) active @endif"><a href="{{ route('schools.index') }}"
                                                                                    class="nav-link"><i
                    data-feather="user"></i>
            <span>Schools</span></a></li>
    <li class="nav-item with-sub">
        <a href="" class="nav-link"><i data-feather="user"></i> <span>User Pages</span></a>
        <ul>
            <li><a href="page-profile-view.html">View Profile</a></li>
            <li><a href="page-connections.html">Connections</a></li>
            <li><a href="page-groups.html">Groups</a></li>
            <li><a href="page-events.html">Events</a></li>
        </ul>
    </li>
    <li class="nav-item with-sub">
        <a href="" class="nav-link"><i data-feather="file"></i> <span>Setting</span></a>
        <ul>
            <li><a href="{{route('wa.index')}}">WhatsApp</a></li>
        </ul>
    </li>
    <li class="nav-label mg-t-25">User Interface</li>
    <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i>
            <span>Components</span></a></li>
    <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i>
            <span>Collections</span></a></li>
</ul>
