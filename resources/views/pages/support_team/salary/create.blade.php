@extends('layouts.master')
@section('page_title', 'বেতন তৈরি করুন')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">নতুন বেতন রেকর্ড তৈরি করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('salaries.store') }}" class="">
                {{--            <form method="post" action="{{ route('salaries.store') }}">--}}

                @csrf
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">গ্রহীতা <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required class="form-control select" name="receiver">
                            <option value="">গ্রহীতা নির্বাচন করুন</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('receiver') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">পরিমাণ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="amount" required type="number" step="0.01" min="0" class="form-control" placeholder="পরিমাণ লিখুন">
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">
                        তারিখ <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input name="date" value="{{ old('date') }}" required type="date" class="form-control" placeholder="তারিখ">
                    </div>
                </div>

                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-lg-3 col-form-label font-weight-semibold">প্রকার <span class="text-danger">*</span></label>--}}
                {{--                    <div class="col-lg-9">--}}
                {{--                        <select required class="form-control select" name="type">--}}
                {{--                            <option value="monthly">মাসিক</option>--}}
                {{--                            <option value="yearly">বার্ষিক</option>--}}
                {{--                        </select>--}}
                {{--                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
