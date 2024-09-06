@php
$count = \App\Models\Student::where('user_id', auth()->id())->get()->count();
@endphp
<ul class="nav nav-aside">
    <li class="nav-label">Dashboard</li>
    <li class="nav-item @if (request()->routeIs('student.index')) active @endif">
        <a href="{{ route('student.index') }}" class="nav-link"><i data-feather="shopping-bag"></i>
            <span>Dashboard</span></a></li>
    @if($count==1)
{{--    <li class="nav-item @if (request()->routeIs('editbiodata')) active @endif"><a--}}
{{--            href="{{ route('editbiodata') }}" class="nav-link"><i--}}
{{--                data-feather="user"></i><span>Biodata</span></a></li>--}}
        <li class="nav-item @if (request()->routeIs('isibiodata')) active @endif"><a
            href="{{ route('isibiodata') }}" class="nav-link"><i
                data-feather="user"></i><span>Biodata</span></a></li>
    <li class="nav-item @if (request()->routeIs('pembayaran.index')) active @endif"><a
            href="{{ route('pembayaran.index') }}" class="nav-link"><i
                data-feather="life-buoy"></i><span>Pembayaran</span></a></li>
    @endif
</ul>
