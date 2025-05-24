@extends('layouts.master')
@section('page_title', 'রিপোর্ট')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="mx-auto card-title text-black-50">{{ $report['year'] }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-notices">
                    <!-- ফিল্টার ফর্ম -->
                    <form method="GET" action="{{ route('yearly_profit_loss_report.index') }}">
                        <div class="row mb-3">
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

                            <!-- সাবমিট বাটন -->
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">ফিল্টার করুন</button>
                            </div>
                        </div>
                    </form>

                    <!-- রিপোর্ট টেবিল -->
                    <table class="table">
                        <tbody>
                        <tr><th>মোট আয়</th> <td>{{ $report['total_income'] }}</td></tr>
                        <tr><th>মোট বেতন</th> <td>{{ $report['total_salaries'] }}</td></tr>
                        <tr><th>মোট খরচ</th> <td>{{ $report['total_expenses'] }}</td></tr>
                        <tr><th>মোট ভর্তি</th> <td>{{ $report['totalAdmissionThisMonth'] }}</td></tr>
                        <tr><th>লাভ / ক্ষতি</th> <td>{{ $report['profit_or_loss'] }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
