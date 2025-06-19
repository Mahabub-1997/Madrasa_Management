@extends('layouts.master')
@section('page_title', 'বেতন বিস্তারিত')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">বেতন তথ্য</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="basic-info">
                            <table class="table table-bordered">
                                <tbody>
                                {{--                                <tr>--}}
                                {{--                                    <td class="font-weight-bold">ব্যবহারকারীর আইডি</td>--}}
                                {{--                                    <td>{{ $salary->user_id }}</td>--}}
                                {{--                                </tr>--}}
                                <tr>
                                    <td class="font-weight-bold">গ্রহীতার আইডি</td>
                                    <td>{{ $salary->receiver }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">উদ্দেশ্য</td>
                                    <td>{{ $salary->purpose }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">পরিমাণ</td>
                                    <td>{{ number_format($salary->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">মাস</td>
                                    <td>{{ $salary->month }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">বছর</td>
                                    <td>{{ $salary->year }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">ধরন</td>
                                    <td>{{ ucfirst($salary->type) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">তৈরি হয়েছে</td>
                                    <td>{{ $salary->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
