<ul class="nav nav-aside">
    <li class="nav-label">Dashboard</li>
    <li class="nav-item @if (request()->routeIs('student.index')) active @endif"><a href="{{ route('student.index') }}"
                                                                                    class="nav-link"><i
                    data-feather="shopping-bag"></i>
            <span>Dashboard</span></a></li>
    @php
        $hitung = App\Models\Student::where('user_id', auth()->id())
            ->get()
            ->count();
    @endphp
    @if ($hitung != 1)
    @else
        <li class="nav-item @if (request()->routeIs('isibiodata')) active @endif"><a
                    href="{{ route('isibiodata') }}" class="nav-link"><i
                        data-feather="user"></i><span>Isi Biodata</span></a></li>
        <li class="nav-item @if (request()->routeIs('payment.index')) active @endif"><a
                    href="{{ route('payment.index') }}" class="nav-link"><i
                        data-feather="life-buoy"></i><span>Pembayaran</span></a></li>
    @endif
    <li class="nav-label mg-t-25">Web Apps</li>
    <li class="nav-item"><a href="app-calendar.html" class="nav-link"><i data-feather="calendar"></i>
            <span>Calendar</span></a></li>
    <li class="nav-item"><a href="app-chat.html" class="nav-link"><i data-feather="message-square"></i>
            <span>Chat</span></a></li>
    <li class="nav-item"><a href="app-contacts.html" class="nav-link"><i data-feather="users"></i>
            <span>Contacts</span></a></li>
    <li class="nav-item"><a href="app-file-manager.html" class="nav-link"><i data-feather="file-text"></i>
            <span>File Manager</span></a></li>
    <li class="nav-item"><a href="app-mail.html" class="nav-link"><i data-feather="mail"></i>
            <span>Mail</span></a></li>


    <li class="nav-label mg-t-25">Pages</li>
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
        <a href="" class="nav-link"><i data-feather="file"></i> <span>Other Pages</span></a>
        <ul>
            <li><a href="page-timeline.html">Timeline</a></li>
        </ul>
    </li>
    <li class="nav-label mg-t-25">User Interface</li>
    <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i>
            <span>Components</span></a></li>
    <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i>
            <span>Collections</span></a></li>
</ul>
