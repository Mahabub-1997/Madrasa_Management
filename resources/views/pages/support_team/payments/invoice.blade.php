@extends('layouts.master')
@section('page_title', 'পেমেন্ট ব্যবস্থাপনা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">পেমেন্ট রেকর্ড ব্যবস্থাপনা - {{ $sr->user->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-uc">
                    <table class="table datatable-button-html5-columns table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>টিউশন ফি</th>
                            <th>খোরাকি</th>
                            <th>ছাড়</th>
                            <th>প্রদত্ত</th>
                            <th>বাকি</th>
                            <th>এখন পরিশোধ</th>
                            <th>মাস/বছর</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payable_months as $p)
                            <tr>
                                <td>#</td>
                                <td>{{ $p['tution_fee'] }}</td>
                                <td>
                                    @if($p['is_residential'] == 1)
                                        {{ $p['khoraki'] }}
                                    @else
                                        অনাবাসিক
                                    @endif
                                </td>
                                <form method="post" action="{{route('payments.pay_now')}}">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $sr->user->id }}">
                                    <input type="hidden" name="month" value="{{ $p['month'] }}">
                                    <input type="hidden" name="year" value="{{ $p['year'] }}">
                                    <input type="hidden" name="is_residential" value="{{ $p['is_residential'] }}">
                                    @if(isset($p['pr_id']))
                                        <input type="hidden" name="pr_id" value="{{ $p['pr_id'] }}">
                                    @endif
                                    <td>
                                        <input type="number" min="0" name="discount" required class="form-control" value="{{ $sr->discount }}">
                                    </td>
                                    <td>{{ $p['amt_paid'] }}</td>
                                    <td>{{ $p['due'] }}</td>
                                    <td>
                                        <div class="row">
                                            @if($p['paid'] == 0)
                                                <div class="col-md-7">
                                                    <input type="number" min="0" name="amt_paid" required class="form-control" placeholder="এখন পরিশোধ করুন">
                                                </div>
                                                <div class="col-md-5">
                                                    <button type="submit" class="btn btn-danger">পরিশোধ <i class="icon-paperplane ml-2"></i></button>
                                                </div>
                                            @else
                                                <div class="col-md-5">
                                                    <i class="icon-check text-success"></i>
                                                    <i class="icon-check text-success"></i>
                                                    <i class="icon-check text-success"></i>
                                                    সম্পন্ন
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </form>
                                <td>{{ $p['month']}}, {{ $p['year'] }}</td>
                                <td class="text-center">
                                    @if(isset($p['pr_id']))
                                        <a href="{{ route('payments.receipts', ['pr_id'=>$p['pr_id']]) }}">
                                            <i class="icon-printer text-primary"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- পরিস্কার করা পেমেন্ট লিস্ট (কমেন্ট আকারে রাখা হয়েছে) --}}
                {{--
                <div class="tab-pane fade" id="all-cl">
                    <table class="table datatable-button-html5-columns table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>শিরোনাম</th>
                            <th>পেমেন্ট রেফারেন্স</th>
                            <th>পরিমাণ</th>
                            <th>রসিদ নম্বর</th>
                            <th>বছর</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cleared as $cl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cl->payment->title }}</td>
                                <td>{{ $cl->payment->ref_no }}</td>
                                <td class="font-weight-bold">{{ $cl->payment->amount }}</td>
                                <td>{{ $cl->ref_no }}</td>
                                <td>{{ $cl->year }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a id="{{ Qs::hash($cl->id) }}" onclick="confirmReset(this.id)" href="#" class="dropdown-item">
                                                    <i class="icon-reset"></i> রিসেট পেমেন্ট
                                                </a>
                                                <form method="post" id="item-reset-{{ Qs::hash($cl->id) }}" action="{{ route('payments.reset_record', Qs::hash($cl->id)) }}" class="hidden">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <a target="_blank" href="{{ route('payments.receipts', Qs::hash($cl->id)) }}" class="dropdown-item">
                                                    <i class="icon-printer"></i> রসিদ প্রিন্ট করুন
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                --}}
            </div>
        </div>
    </div>

@endsection
