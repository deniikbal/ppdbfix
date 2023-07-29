<div class="d-flex align-items-center justify-content-start">
    <a href="" class="avatar"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></a>
    <div class="aside-alert-link">
        <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i
                data-feather="message-square"></i></a>
        <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i
                data-feather="bell"></i></a>
        <a data-toggle="tooltip" title="Sign out" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i data-feather="log-out"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
<div class="aside-loggedin-user">
    <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
        <h6 class="tx-semibold mg-b-0">{{ Auth::user()->name }}</h6>
        <i data-feather="chevron-down"></i>
    </a>
    <p class="tx-12 mg-b-0 badge badge-danger">{{ Illuminate\Support\Str::ucfirst(Auth::user()->role) }}</p>
</div>
<div class="collapse" id="loggedinMenu">
    <ul class="nav nav-aside mg-b-0">
        <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i> <span>Edit
                    Profile</span></a></li>
        <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i> <span>View
                    Profile</span></a></li>
        <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i>
                <span>Account Settings</span></a></li>
        <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i>
                <span>Help Center</span></a></li>
        <li>
            <a data-toggle="tooltip" title="Sign out" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="log-out"></i> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
