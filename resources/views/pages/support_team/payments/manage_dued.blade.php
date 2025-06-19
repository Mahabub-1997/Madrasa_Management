@extends('layouts.master')
@section('page_title', 'শিক্ষার্থীদের বকেয়া পেমেন্ট')
@section('content')
    @if($selected)
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"> {{ $month }} {{ $year }} মাসের শিক্ষার্থীদের বকেয়া পেমেন্ট</h6>
                {!! Qs::getPanelOptions() !!}
                <a href="{{route('payments.dued.print',['month'=>$month, 'year'=>$year])}}" class="btn btn-success">প্রিন্ট</a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('payments.manage.dued') }}">
                    <div class="row mb-3">
                        <!-- মাস নির্বাচন -->
                        <div class="col-md-4">
                            <select class="form-control" name="month">
                                <option value="">মাস নির্বাচন করুন</option>
                                @foreach(range(1, 12) as $m)
                                        <?php $monthName = date("F", mktime(0, 0, 0, $m, 1)); ?>
                                    <option value="{{ $monthName }}" {{ request('month') == $monthName ? 'selected' : '' }}>
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- বছর নির্বাচন -->
                        <div class="col-md-4">
                            <select class="form-control" name="year">
                                <option value="">বছর নির্বাচন করুন</option>
                                @for($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- ফিল্টার বোতাম -->
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">ফিল্টার করুন</button>
                        </div>
                    </div>
                </form>

                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>ক্রমিক</th>
                        <th>ছবি</th>
                        <th>নাম</th>
                        <th>ভর্তির তারিখ</th>
                        <th>বকেয়া</th>
                        <th>পেমেন্ট</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset($s->user->photo) }}" alt="ছবি"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->admission_date }}</td>
                            <td>
                                @if($s->is_residential==1)
                                    {{ $s->payment_records->due ?? $fee_info->tution_fee + $fee_info->khoraki - $s->discount }}
                                @else
                                    {{ $s->payment_records->due ?? $fee_info->tution_fee - $s->discount }}
                                @endif
                            </td>
                            <td>
                                <div class="">
                                    <a href="{{ route('payments.invoice', [Qs::hash($s->user_id)]) }}" class="btn btn-danger"> পেমেন্ট ম্যানেজ করুন
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
