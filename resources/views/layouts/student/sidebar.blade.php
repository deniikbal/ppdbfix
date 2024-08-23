<ul class="nav nav-aside">
    <li class="nav-label">Dashboard</li>
    <li class="nav-item @if (request()->routeIs('student.index')) active @endif">
        <a href="{{ route('student.index') }}" class="nav-link"><i data-feather="shopping-bag"></i>
            <span>Dashboard</span></a></li>
    <li class="nav-item @if (request()->routeIs('editbiodata')) active @endif"><a
            href="{{ route('editbiodata') }}" class="nav-link"><i
                data-feather="user"></i><span>Biodata</span></a></li>
    <li class="nav-item @if (request()->routeIs('pembayaran.index')) active @endif"><a
            href="{{ route('pembayaran.index') }}" class="nav-link"><i
                data-feather="life-buoy"></i><span>Pembayaran</span></a></li>
</ul>
