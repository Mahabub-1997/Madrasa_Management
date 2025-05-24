@extends('layouts.master')
@section('page_title', 'ছাত্র ভর্তি করুন')
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">একজন নতুন ছাত্র ভর্তির জন্য নিচের ফর্মটি পূরণ করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.store') }}">
            @csrf

            <!-- ব্যক্তিগত তথ্য -->
            <h6>ব্যক্তিগত তথ্য</h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>পূর্ণ নাম: <span class="text-danger">*</span></label>
                            <input value="{{ old('student_name') }}" required type="text" name="student_name" placeholder="পূর্ণ নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ইমেইল ঠিকানা:</label>
                            <input value="{{ old('email') }}" type="email" name="email" placeholder="ইমেইল ঠিকানা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>লিঙ্গ: <span class="text-danger">*</span></label>
                            <select class="select form-control" name="gender" required data-placeholder="নির্বাচন করুন...">
                                <option value=""></option>
                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">পুরুষ</option>
                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">নারী</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>মোবাইল:</label>
                            <input value="{{ old('phone') }}" type="text" name="phone" placeholder="মোবাইল নম্বর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>বিকল্প মোবাইল:</label>
                            <input value="{{ old('phone2') }}" type="text" name="phone2" placeholder="বিকল্প মোবাইল নম্বর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>জন্ম তারিখ:</label>
                            <input name="dob" value="{{ old('dob') }}" type="date" class="form-control" placeholder="তারিখ নির্বাচন করুন">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পিতার নাম:</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" placeholder="পিতার নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>মাতার নাম:</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" placeholder="মাতার নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>অভিভাবকের নাম (প্রযোজ্য হলে):</label>
                            <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" placeholder="অভিভাবকের নাম" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>স্থায়ী ঠিকানা:</label>
                            <input type="text" name="permanent_address" value="{{ old('permanent_address') }}" placeholder="স্থায়ী ঠিকানা" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>গ্রাম:</label>
                            <input type="text" name="village" value="{{ old('village') }}" placeholder="গ্রাম" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ডাকঘর:</label>
                            <input type="text" name="post_office" value="{{ old('post_office') }}" placeholder="ডাকঘর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>থানা:</label>
                            <input type="text" name="police_station" value="{{ old('police_station') }}" placeholder="থানা" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>জেলা:</label>
                            <input type="text" name="district" value="{{ old('district') }}" placeholder="জেলা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের সম্পর্ক:</label>
                            <input type="text" name="guardian_relation" value="{{ old('guardian_relation') }}" placeholder="অভিভাবকের সম্পর্ক" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের পেশা:</label>
                            <input type="text" name="guardian_occupation" value="{{ old('guardian_occupation') }}" placeholder="অভিভাবকের পেশা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের মোবাইল:</label>
                            <input type="text" name="guardian_mobile" value="{{ old('guardian_mobile') }}" placeholder="অভিভাবকের মোবাইল" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>পাসপোর্ট সাইজ ছবি আপলোড করুন:</label>
                            <input type="file" name="photo" accept="image/*" class="form-input-styled" data-fouc>
                            <span class="form-text text-muted">গ্রহণযোগ্য ছবি: jpeg, png. সর্বোচ্চ সাইজ ২ এমবি</span>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- শিক্ষাগত তথ্য -->
            <h6>শিক্ষাগত তথ্য</h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>শ্রেণী: <span class="text-danger">*</span></label>
                            <select onchange="getClassSections(this.value)" required name="my_class_id" id="my_class_id" class="select-search form-control" data-placeholder="নির্বাচন করুন...">
                                <option value=""></option>
                                @foreach($my_classes as $c)
                                    <option {{ (old('my_class_id') == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>বিভাগ:</label>
                            <select name="department" class="select-search form-control" data-placeholder="বিভাগ নির্বাচন করুন">
                                <option value=""></option>
                                <option {{ (old('department') == 'noorani') ? 'selected' : '' }} value="noorani">নূরাণী বিভাগ</option>
                                <option {{ (old('department') == 'najera') ? 'selected' : '' }} value="najera">নাজেরা বিভাগ</option>
                                <option {{ (old('department') == 'hifz') ? 'selected' : '' }} value="hifz">হিফয বিভাগ</option>
                                <option {{ (old('department') == 'sunani') ? 'selected' : '' }} value="sunani">শুনানি বিভাগ</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ভর্তির নম্বর:</label>
                            <input type="text" name="adm_no" value="{{ old('adm_no') }}" class="form-control" placeholder="ভর্তির নম্বর (অথবা খালি রাখুন)">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ছাড়:</label>
                            <input type="number" name="discount" placeholder="ছাড় (যদি থাকে)" class="form-control" value="{{ old('discount', 0) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>বয়স:</label>
                            <input type="text" name="age" placeholder="বয়স" class="form-control" value="{{ old('age') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ভর্তির তারিখ:</label>
                            <input type="text" name="admission_date" value="{{ old('admission_date') }}" class="form-control date-pick" placeholder="তারিখ নির্বাচন করুন">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পূর্ববর্তী প্রতিষ্ঠানের নাম:</label>
                            <input type="text" name="previous_institution_name" value="{{ old('previous_institution_name') }}" placeholder="প্রতিষ্ঠানের নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>প্রতিষ্ঠানের ঠিকানা:</label>
                            <input type="text" name="previous_institution_address" value="{{ old('previous_institution_address') }}" placeholder="ঠিকানা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পূর্ববর্তী শ্রেণী:</label>
                            <input type="text" name="prev_class_admitted" placeholder="পূর্ববর্তী শ্রেণী" class="form-control" value="{{ old('prev_class_admitted') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পরীক্ষক:</label>
                            <input type="text" name="examiner" placeholder="পরীক্ষকের নাম" class="form-control" value="{{ old('examiner') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>সাবেক পরীক্ষার ফলাফল:</label>
                            <input type="text" name="prev_exam_result" placeholder="সাবেক পরীক্ষার ফলাফল" class="form-control" value="{{ old('prev_exam_result') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>সাবেক আরবি ফলাফল:</label>
                            <input type="text" name="prev_arabic_result" placeholder="সাবেক আরবি ফলাফল" class="form-control" value="{{ old('prev_arabic_result') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>সাবেক একাডেমিক ফলাফল:</label>
                            <input type="text" name="prev_academic_result" placeholder="সাবেক একাডেমিক ফলাফল" class="form-control" value="{{ old('prev_academic_result') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>আবাসিক অবস্থা:</label>
                            <select name="is_residential" class="select-search form-control" data-placeholder="নির্বাচন করুন">
                                <option value="0" {{ (old('is_residential', 0) == 0) ? 'selected' : '' }}>অনাবাসিক</option>
                                <option value="1" {{ (old('is_residential') == 1) ? 'selected' : '' }}>আবাসিক</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
