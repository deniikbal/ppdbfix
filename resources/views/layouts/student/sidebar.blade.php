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
</ul>
