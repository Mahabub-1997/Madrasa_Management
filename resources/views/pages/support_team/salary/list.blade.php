@extends('layouts.master')
@section('page_title', 'বেতন ব্যবস্থাপনা')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">বেতন রেকর্ডসমূহ</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-salaries" class="nav-link active" data-toggle="tab">বেতন পরিচালনা করুন</a></li>
                <li class="nav-item"><a href="{{ route('salaries.create') }}" class="nav-link"><i class="icon-plus2"></i> বেতন তৈরি করুন</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-salaries">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            {{--                            <th>ব্যবহারকারীর আইডি</th>--}}
                            <th>গ্রহীতা</th>
                            <th>পরিমাণ</th>
                            <th>তারিখ</th>
                            <th>ধরন</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($salaries as $salary)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{--                                <td>{{ $salary->user ? $salary->user->name : 'N/A' }}</td>--}}
                                <td>{{ $salary->receiverUser ? $salary->receiverUser->name : 'N/A' }}</td>
                                <td>{{ number_format($salary->amount, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($salary->date)->format('d M Y') }}</td> <!-- Display the formatted date -->
                                <td>{{ $salary->type == 'monthly' ? 'মাস': ' বছর'}}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a href="{{ route('salaries.show', $salary->id) }}" class="dropdown-item"><i class="icon-eye"></i> দেখুন</a>
                                                <a href="{{ route('salaries.edit', $salary->id) }}" class="dropdown-item"><i class="icon-pencil"></i> সংশোধন করুন</a>
                                                @if(Qs::userIsSuperAdmin())
                                                    <a id="{{ $salary->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> মুছে ফেলুন</a>
                                                    <form method="post" id="item-delete-{{ $salary->id }}" action="{{ route('salaries.destroy', $salary->id) }}" class="hidden">@csrf @method('delete')</form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7">কোনো বেতন রেকর্ড পাওয়া যায়নি।</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
