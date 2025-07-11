<div class="navbar navbar-expand-md navbar-dark">
    <div class="mt-2 mr-5">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
        <h4 class="text-bold text-white">{{ Qs::getSystemName() }}</h4>
        </a>
    </div>
  {{--  <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
        </a>
    </div>--}}

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>


        </ul>

			<span class="navbar-text ml-md-3 mr-md-auto"></span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="{{route('notice_board.index')}}" class="navbar-nav-link d-flex align-items-center">
                    @php
                    $noticeboard = Qs::getNotices();
                    @endphp
                    @if(isset($noticeboard))
                        <div class="text-carousel">
                            <div class="text-carousel-inner" style="animation: slideText {{ count($noticeboard) * 8 }}s linear infinite;">
                                @foreach($noticeboard as $notice)
                                    <span>{{ $notice }}</span>
                                    @if(!$loop->last) <span class="separator">|</span> @endif
                                @endforeach
                        </div>
                    @endif
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img style="width: 38px; height:38px;" src="{{ Auth::user()->photo }}" class="rounded-circle" alt="photo">
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ Qs::userIsStudent() ? route('students.show', Qs::hash(Qs::findStudentRecord(Auth::user()->id)->id)) : route('users.show', Qs::hash(Auth::user()->id)) }}" class="dropdown-item"><i class="icon-user-plus"></i>আমার প্রোফাইল</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i> প্রোফাইল সেটিংস</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> লগ-আউট</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
