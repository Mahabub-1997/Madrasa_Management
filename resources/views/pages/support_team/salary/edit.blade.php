@extends('layouts.master')
@section('page_title', 'বেতন সম্পাদনা করুন')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">বেতন রেকর্ড সম্পাদনা করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('salaries.update', $salary->id) }}" >
                @csrf
                @method('PUT')
                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-lg-3 col-form-label font-weight-semibold">ব্যবহারকারী <span class="text-danger">*</span></label>--}}
                {{--                    <div class="col-lg-9">--}}
                {{--                        <select required class="form-control select" name="user_id">--}}
                {{--                            <option value="">ব্যবহারকারী নির্বাচন করুন</option>--}}
                {{--                            @foreach($users as $user)--}}
                {{--                                <option value="{{ $user->id }}" {{ $salary->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>--}}
                {{--                            @endforeach--}}
                {{--                        </select>--}}
                {{--                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">গ্রহীতা <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required class="form-control select" name="receiver">
                            <option value="">গ্রহীতা নির্বাচন করুন</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $salary->receiver == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('receiver') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">পরিমাণ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="amount" value="{{ $salary->amount }}" required type="number" step="0.01" min="0" class="form-control">
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- পরিবর্তিত: মাস ও বছর এর পরিবর্তে তারিখ -->
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">তারিখ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="date" value="{{ old('date', $salary->date) }}" required type="date" class="form-control">
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{--                <div class="form-group row">--}}
                {{--                    <label class="col-lg-3 col-form-label font-weight-semibold">ধরন <span class="text-danger">*</span></label>--}}
                {{--                    <div class="col-lg-9">--}}
                {{--                        <select required class="form-control select" name="type">--}}
                {{--                            <option value="monthly" {{ $salary->type == 'monthly' ? 'selected' : '' }}>মাসিক</option>--}}
                {{--                            <option value="yearly" {{ $salary->type == 'yearly' ? 'selected' : '' }}>বার্ষিক</option>--}}
                {{--                        </select>--}}
                {{--                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">আপডেট করুন <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
