
@extends('layouts.master')

@section('page_title', 'এসএমএস')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">এসএমএস পরিচালনা করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item">
                    <a href="#all-sms" class="nav-link active" data-toggle="tab">এসএমএস তালিকা</a>
                </li>
                <li class="nav-item">
                    <a href="#add-sms" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> নতুন এসএমএস</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- এসএমএস তালিকা -->
                <div class="tab-pane fade show active" id="all-sms">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্রমিক</th>
                            <th>প্রেরক</th>
                            <th>প্রাপক</th>
                            <th>শিরোনাম</th>
                            <th>বার্তা</th>
                            <th>তৈরি তারিখ</th>
                            <th>কার্যক্রম</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $msg)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $msg->sender->name ?? 'N/A' }}</td>
                                <td>{{ $msg->receiver->name ?? 'N/A' }}</td>
                                <td>{{ $msg->title }}</td>
                                <td>{{ $msg->body }}</td>
                                <td>{{ $msg->created_at->format('d M, Y') }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @if(Qs::userIsTeamSA())
                                                    <a href="{{ route('communication.edit', $msg->id) }}" class="dropdown-item">
                                                        <i class="icon-pencil"></i> সংশোধন
                                                    </a>
                                                @endif
                                                    @if(Qs::userIsSuperAdmin())
                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('item-delete-{{ $msg->id }}').submit();" class="dropdown-item">
                                                            <i class="icon-trash"></i> মুছে ফেলুন
                                                        </a>

                                                        <form method="POST" id="item-delete-{{ $msg->id }}" action="{{ route('communication.destroy', $msg->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- নতুন এসএমএস যোগ করার ফর্ম -->
                <div class="tab-pane fade" id="add-sms">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="{{ route('communication.store') }}">
                                @csrf
                                <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">প্রেরক <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <!-- Display sender name with margin-right -->
                                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly style="margin-right: 320px;">

                                            <!-- Hidden field to submit sender_id -->
                                            <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">গ্রহীতা <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required class="form-control select" name="receiver_id" id="receiver_id">
                                            <option value="">গ্রহীতা নির্বাচন করুন</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('receiver_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">শিরোনাম <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="title" value="{{ old('title') }}" required type="text" class="form-control" placeholder="এসএমএস  শিরোনাম">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">বার্তা <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <textarea name="body" required class="form-control" placeholder="এসএমএস বার্তা">{{ old('body') }}</textarea>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ফর্ম শেষ -->
            </div>
        </div>
    </div>
@endsection
