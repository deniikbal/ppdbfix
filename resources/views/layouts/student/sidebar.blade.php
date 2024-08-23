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
        $activxendit = App\Models\WhatsApp::find(1);
    @endphp
    @if ($hitung != 1)
    @else

        @if($activxendit->active==1)
            <li class="nav-item @if (request()->routeIs('payment.index')) active @endif"><a
                        href="{{ route('payment.index') }}" class="nav-link"><i
                            data-feather="life-buoy"></i><span>Pembayaran Xendit</span></a></li>
        @else
            <li class="nav-item @if (request()->routeIs('pembayaran.index')) active @endif"><a
                        href="{{ route('pembayaran.index') }}" class="nav-link"><i
                            data-feather="life-buoy"></i><span>Pembayaran</span></a></li>
        @endif
        <li class="nav-item @if (request()->routeIs('editbiodata')) active @endif"><a
                    href="{{ route('editbiodata') }}" class="nav-link"><i
                        data-feather="user"></i><span>Biodata</span></a></li>
    @endif
</ul>
