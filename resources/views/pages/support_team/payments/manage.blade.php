@extends('layouts.master')
@section('page_title', 'শিক্ষার্থীদের পেমেন্ট')
@section('content')
    @if($selected)
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"> শিক্ষার্থীদের পেমেন্ট</h6>
                {!! Qs::getPanelOptions() !!}
            </div>
            <div class="card-body">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>ক্রমিক</th>
                        <th>ছবি</th>
                        <th>নাম</th>
                        <th>ভর্তি নম্বর</th>
                        <th>পেমেন্ট</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset($s->user->photo) }}" alt="ছবি"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->adm_no }}</td>
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
