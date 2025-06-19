@extends('layouts.master')
@section('page_title', 'ব্যয় তালিকা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">ব্যয় তালিকা</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item">
                    <a href="#all-expenses" class="nav-link active" data-toggle="tab">ব্যয় পরিচালনা করুন</a>
                </li>
                <li class="nav-item">
                    <a href="#add-expense" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> নতুন ব্যয় যোগ করুন</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- ব্যয় তালিকা টেবিল -->
                <div class="tab-pane fade show active" id="all-expenses">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্রমিক</th>
                            <th>উদ্দেশ্য</th>
                            <th>পরিমাণ</th>
                            <th>তারিখ</th>
                            <th>ধরন</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $val->purpose }}</td>
                                <td>{{ number_format($val->amount, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($val->date)->format('d M, Y') }}</td>
                                <td>{{ ($val->type == 'monthly' ? 'মাস': ' বছর') }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a href="{{ route('expenses.edit', $val->id) }}" class="dropdown-item">
                                                    <i class="icon-pencil"></i> সংশোধন
                                                </a>
                                                <a id="{{ $val->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item">
                                                    <i class="icon-trash"></i> মুছে ফেলুন
                                                </a>
                                                <form method="post" id="item-delete-{{ $val->id }}" action="{{ route('expenses.destroy', $val->id) }}" class="hidden">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- নতুন ব্যয় যোগ করার ফর্ম -->
                <div class="tab-pane fade" id="add-expense">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="{{ route('expenses.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        উদ্দেশ্য <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="purpose" value="{{ old('purpose') }}" required type="text" class="form-control @error('purpose') is-invalid @enderror" placeholder="উদ্দেশ্য লিখুন">
                                        @error('purpose')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        পরিমাণ <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="amount" value="{{ old('amount') }}" required type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" placeholder="পরিমাণ লিখুন">
                                        @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        তারিখ <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="date" value="{{ old('date') }}" required type="date" class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label class="col-lg-3 col-form-label font-weight-semibold">--}}
                                {{--                                        ধরন--}}
                                {{--                                    </label>--}}
                                {{--                                    <div class="col-lg-9">--}}
                                {{--                                        <select class="form-control select @error('type') is-invalid @enderror" name="type">--}}
                                {{--                                            <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>মাসিক</option>--}}
                                {{--                                            <option value="yearly" {{ old('type') == 'yearly' ? 'selected' : '' }}>বার্ষিক</option>--}}
                                {{--                                        </select>--}}
                                {{--                                        @error('type')--}}
                                {{--                                        <small class="text-danger">{{ $message }}</small>--}}
                                {{--                                        @enderror--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- নতুন ব্যয় যোগ করার ট্যাব শেষ -->
            </div>
        </div>
    </div>

@endsection
