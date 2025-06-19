{{-- সেটিংস পরিচালনা করুন --}}
<li class="nav-item">
    <a href="{{ route('settings') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['settings',]) ? 'active' : '' }}">
        <i class="icon-gear"></i> <span>সেটিংস</span>
    </a>
</li>

{{-- পিনস --}}
{{--<li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['pins.create', 'pins.index']) ? 'nav-item-expanded nav-item-open' : '' }}">--}}
{{--    <a href="#" class="nav-link"><i class="icon-lock2"></i> <span>পিনস</span></a>--}}

{{--    <ul class="nav nav-group-sub" data-submenu-title="পিনস পরিচালনা করুন">--}}
{{--        --}}{{-- পিনস তৈরি করুন --}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('pins.create') }}" class="nav-link {{ (Route::is('pins.create')) ? 'active' : '' }}">--}}
{{--                পিনস তৈরি করুন--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        --}}{{-- পিনস দেখুন --}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('pins.index') }}" class="nav-link {{ (Route::is('pins.index')) ? 'active' : '' }}">--}}
{{--                পিনস দেখুন--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</li>--}}
