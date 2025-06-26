@extends('layouts.master')

@section('page_title', 'এসএমএস সংশোধন')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">এসএমএস সংশোধন করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('communication.update', $message->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">প্রেরক <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required class="form-control select" name="user_type" id="user_type">
                            <option value="">প্রেরক নির্বাচন করুন</option>
                            @foreach($users as $ut)
                                <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                            @endforeach
                        </select>
                        @error('sender_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">গ্রহীতা <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select required class="form-control select" name="receiver_id" id="receiver_id">
                            <option value="">গ্রহীতা নির্বাচন করুন</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $message->receiver_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('receiver_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">শিরোনাম <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="title" value="{{ old('title', $message->title) }}" required type="text" class="form-control" placeholder="বার্তার শিরোনাম">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">বার্তা <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <textarea name="body" required class="form-control" placeholder="এসএমএস বার্তা">{{ old('body', $message->body) }}</textarea>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">আপডেট করুন <i class="icon-check ml-2"></i></button>
                    <a href="{{ route('communication.index') }}" class="btn btn-secondary">ফিরে যান</a>
                </div>
            </form>
        </div>
    </div>
@endsection
