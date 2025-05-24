@extends('layouts.master')
@section('page_title', 'সিস্টেম সেটিংস পরিচালনা করুন')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-semibold">সিস্টেম সেটিংস আপডেট করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{ route('settings.update') }}">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 border-right-2 border-right-blue-400">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="system_name" value="{{ $s['system_name'] }}" required type="text" class="form-control" placeholder="প্রতিষ্ঠানের নাম">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current_session" class="col-lg-3 col-form-label font-weight-semibold">চলতি সেশন <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select required name="current_session" id="current_session" class="select-search form-control">
                                    <option value=""></option>
                                    @for($y = date('Y', strtotime('- 3 years')); $y <= date('Y', strtotime('+ 1 years')); $y++)
                                        <option {{ ($s['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">সংক্ষিপ্ত নাম</label>
                            <div class="col-lg-9">
                                <input name="system_title" value="{{ $s['system_title'] }}" type="text" class="form-control" placeholder="সংক্ষিপ্ত নাম">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">ফোন</label>
                            <div class="col-lg-9">
                                <input name="phone" value="{{ $s['phone'] }}" type="text" class="form-control" placeholder="ফোন">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">ইমেইল</label>
                            <div class="col-lg-9">
                                <input name="system_email" value="{{ $s['system_email'] }}" type="email" class="form-control" placeholder="ইমেইল">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">ঠিকানা <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="address" value="{{ $s['address'] }}" required type="text" class="form-control" placeholder="ঠিকানা">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">এই টার্ম শেষ হবে</label>
                            <div class="col-lg-6">
                                <input name="term_ends" value="{{ $s['term_ends'] }}" type="text" class="form-control date-pick" placeholder="টার্ম শেষের তারিখ">
                            </div>
                            <div class="col-lg-3 mt-2">
                                <span class="font-weight-bold font-italic">মাস-দিন-বছর</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">পরবর্তী টার্ম শুরু</label>
                            <div class="col-lg-6">
                                <input name="term_begins" value="{{ $s['term_begins'] }}" type="text" class="form-control date-pick" placeholder="টার্ম শুরুর তারিখ">
                            </div>
                            <div class="col-lg-3 mt-2">
                                <span class="font-weight-bold font-italic">মাস-দিন-বছর</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lock_exam" class="col-lg-3 col-form-label font-weight-semibold">পরীক্ষা লক</label>
                            <div class="col-lg-3">
                                <select class="form-control select" name="lock_exam" id="lock_exam">
                                    <option {{ $s['lock_exam'] ? 'selected' : '' }} value="1">হ্যাঁ</option>
                                    <option {{ !$s['lock_exam'] ? 'selected' : '' }} value="0">না</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <span class="font-weight-bold font-italic text-info-800">{{ __('msg.lock_exam') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- ফি --}}
                        <fieldset>
                            <legend><strong>পরবর্তী টার্মের ফি</strong></legend>
                            @foreach($class_types as $ct)
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">{{ $ct->name }}</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" value="{{ $s['next_term_fees_'.strtolower($ct->code)] }}" name="next_term_fees_{{ strtolower($ct->code) }}" placeholder="{{ $ct->name }}" type="text">
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>

                        <hr class="divider">

                        {{-- লোগো --}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">লোগো পরিবর্তন:</label>
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <img style="width: 100px" height="100px" src="{{ $s['logo'] }}" alt="লোগো">
                                </div>
                                <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="divider">

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">ফর্ম জমা দিন <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

    {{-- সিস্টেম সেটিংস শেষ --}}
@endsection
