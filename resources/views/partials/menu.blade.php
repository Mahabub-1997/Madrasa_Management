<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notice_board.index') }}" class="nav-link {{ (Route::is('NoticeBoard.index')) ? 'active' : '' }}">
                        <i class="icon-bubble-notification"></i>
                        <span>নোটিশ বোর্ড</span>
                    </a>
                </li>
                {{--Administrative--}}
                @if(Qs::userIsAdministrative())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'expenses.index', 'profit_loss_report.index', 'salaries.index', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.manage.dued', 'payments.show', 'yearly_profit_loss_report.index', 'profit_loss_report.index']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> প্রশাসক </span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Administrative">

                            {{--Payments--}}
                            @if(Qs::userIsTeamAccount())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.manage.dued', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">

                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.manage.dued', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">পরিশোধ</a>

                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('payments.create') }}" class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">পরিশোধ সংক্রান্ত তথ্য</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">শিক্ষার্থীদের পরিশোধ </a></li>
                                    <li class="nav-item"><a href="{{ route('payments.manage.dued') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage.dued', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}"> বকেয়া শিক্ষার্থী</a></li>

                                </ul>

                            </li>
                            <li class="nav-item {{ in_array(Route::currentRouteName(), ['expenses.index', 'expense.create', 'expense.edit', 'expense.manage', 'expense.show', 'expense.invoice']) ? 'nav-item-expanded' : '' }}">
                                <a href="{{route('expenses.index')}}" class="nav-link {{ in_array(Route::currentRouteName(), ['expenses.index', 'expense.edit', 'expense.create', 'expense.manage', 'expense.show', 'expense.invoice']) ? 'active' : '' }}">ব্যয়</a>
                            </li>
                            <li class="nav-item {{ in_array(Route::currentRouteName(), ['salaries.index', 'salaries.create', 'salaries.edit', 'salaries.show']) ? 'nav-item-expanded' : '' }}">
                                <a href="{{ route('salaries.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['salaries.index', 'salaries.edit', 'salaries.create', 'salaries.list']) ? 'active' : '' }}">বেতন</a>
                            </li>
                            <li class="nav-item {{ in_array(Route::currentRouteName(), ['profit_loss_report.index']) ? 'nav-item-expanded' : '' }}">
                                <a href="{{ route('profit_loss_report.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['profit_loss_report.index']) ? 'active' : '' }}">লাভ ও ক্ষতির রিপোর্ট</a>
                                <a href="{{ route('yearly_profit_loss_report.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['yearly_profit_loss_report.index']) ? 'active' : '' }}">বার্ষিক লাভ-ক্ষতির প্রতিবেদন</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{--Academics--}}
                @if(Qs::userIsAcademic())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index', 'ttr.edit', 'ttr.show', 'ttr.manage']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> শিক্ষা কার্যক্রম</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">

                            {{--Timetables--}}
                            <li class="nav-item"><a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">সময়সূচি</a></li>
                        </ul>
                    </li>
                @endif

                {{--Manage Students--}}
                @if(Qs::userIsTeamSAT())
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.create', 'students.index', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-users"></i> <span> শিক্ষার্থী</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                            {{--Admit Student--}}
                            @if(Qs::userIsTeamSA())
                                <li class="nav-item">
                                    <a href="{{ route('students.create') }}"
                                       class="nav-link {{ (Route::is('students.create')) ? 'active' : '' }}">নতুন শিক্ষার্থী ভর্তি</a>
                                </li>
                            @endif

                            {{--Student Information--}}
                            <li class="nav-item  {{ in_array(Route::currentRouteName(), ['students.index','students.list', 'students.edit', 'students.show']) ? 'nav-item-expanded' : '' }}">
                                <a href="{{ route('students.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.index', 'students.edit', 'students.show']) ? 'active' : '' }}">শিক্ষার্থীর তথ্য</a>
                            </li>

                            @if(Qs::userIsTeamSA())

                            {{--Student Promotion--}}
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}"><a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage' ]) ? 'active' : '' }}">ছাত্রছাত্রীদের শ্রেণি উন্নয়ন</a>
                            <ul class="nav nav-group-sub">
                                <li class="nav-item"><a href="{{ route('students.promotion') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion']) ? 'active' : '' }}">শ্রেণিোন্নয়নের তালিকা</a></li>
                                <li class="nav-item"><a href="{{ route('students.promotion_manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion_manage']) ? 'active' : '' }}">শ্রেণিোন্নয়ন ব্যবস্থাপনা</a></li>
                            </ul>

                            </li>

{{--                            Student Graduated--}}
                            <li class="nav-item"><a href="{{ route('students.graduated') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated' ]) ? 'active' : '' }}">পাসকৃত শিক্ষার্থী</a></li>
                                @endif

                        </ul>
                    </li>
                @endif

                @if(Qs::userIsTeamSA())
                    {{--Manage Users--}}
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i class="icon-users4"></i> <span> ব্যবহারকারীদের তালিকা</span></a>
                    </li>

                    {{--Manage Classes--}}
                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'active' : '' }}"><i class="icon-windows2"></i> <span> ক্লাসসমূহ</span></a>
                    </li>

                    {{--Manage Dorms--}}
                    <li class="nav-item">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> আবাসন</span></a>
                    </li>

{{--                    Manage Sections--}}
                    <li class="nav-item">
                        <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}"><i class="icon-fence"></i> <span>শাখা</span></a>
                    </li>

{{--                    Manage Subjects--}}
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}"><i class="icon-pin"></i> <span>বিষয়সমূহ</span></a>
                    </li>
                @endif

                {{--Exam--}}
                @if(Qs::userIsTeamSAT())
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-books"></i> <span> পরীক্ষাসমূহ</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Exams">
                        @if(Qs::userIsTeamSA())

{{--                        Exam list--}}
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}"
                                   class="nav-link {{ (Route::is('exams.index')) ? 'active' : '' }}">পরীক্ষার তালিকা</a>
                            </li>

{{--                            Grades list--}}
                            <li class="nav-item">
                                    <a href="{{ route('grades.index') }}"
                                       class="nav-link {{ in_array(Route::currentRouteName(), ['grades.index', 'grades.edit']) ? 'active' : '' }}">ফলাফল</a>
                            </li>

{{--                            Tabulation Sheet--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.tabulation') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">পরীক্ষার ফলাফল তালিকা</a>
                            </li>

{{--                            Marks Batch Fix--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('marks.batch_fix') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.batch_fix']) ? 'active' : '' }}">ব্যাচ সংশোধন</a>--}}
{{--                            </li>--}}
                        @endif

                        @if(Qs::userIsTeamSAT())
{{--                            Marks Manage--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.index') }}"
                                   class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">নম্বর</a>
                            </li>

{{--                            Marksheet--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.bulk') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.bulk', 'marks.show']) ? 'active' : '' }}">নম্বরপত্র </a>
                            </li>

                            @endif

                    </ul>
                </li>
                @endif


{{--                End Exam--}}

                @include('pages.'.Qs::getUserType().'.menu')

                {{--Manage Account--}}
                <li class="nav-item">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>আমার প্রোফাইল</span></a>
                </li>

                </ul>
            </div>
        </div>
</div>
