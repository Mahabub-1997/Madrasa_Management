@extends('layouts.master')
@section('page_title', 'ছাত্র তথ্য সংশোধন')
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">ছাত্র তথ্য সংশোধন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.update', Qs::hash($sr->id)) }}">
            @csrf
            @method('PUT')

            <!-- ব্যক্তিগত তথ্য -->
            <h6>ব্যক্তিগত তথ্য</h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ছাত্রের পূর্ণ নাম: <span class="text-danger">*</span></label>
                            <input value="{{ old('student_name', $sr->student_name) }}" required type="text" name="student_name" placeholder="পূর্ণ নাম লিখুন" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ইমেইল ঠিকানা:</label>
                            <input value="{{ old('email', $sr->user->email) }}" type="email" name="email" placeholder="ইমেইল লিখুন" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>লিঙ্গ: <span class="text-danger">*</span></label>
                            <select class="select form-control" name="gender" required data-placeholder="নির্বাচন করুন...">
                                <option value=""></option>
                                <option {{ (old('gender', $sr->user->gender) == 'Male') ? 'selected' : '' }} value="Male">পুরুষ</option>
                                <option {{ (old('gender', $sr->user->gender) == 'Female') ? 'selected' : '' }} value="Female">মহিলা</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ফোন নম্বর:</label>
                            <input value="{{ old('phone', $sr->user->phone) }}" type="text" name="phone" placeholder="ফোন নম্বর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>বিকল্প ফোন:</label>
                            <input value="{{ old('phone2', $sr->user->phone2) }}" type="text" name="phone2" placeholder="বিকল্প ফোন" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>জন্ম তারিখ:</label>
                            <input name="dob" value="{{ old('dob', $sr->dob) }}" type="date" class="form-control" placeholder="তারিখ নির্বাচন করুন...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পিতার নাম:</label>
                            <input type="text" name="father_name" value="{{ old('father_name', $sr->father_name) }}" placeholder="পিতার নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>মাতার নাম:</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name', $sr->mother_name) }}" placeholder="মাতার নাম" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>অভিভাবকের নাম (যদি থাকে):</label>
                            <input type="text" name="guardian_name" value="{{ old('guardian_name', $sr->guardian_name) }}" placeholder="অভিভাবকের নাম" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>স্থায়ী ঠিকানা:</label>
                            <input type="text" name="permanent_address" value="{{ old('permanent_address', $sr->permanent_address) }}" placeholder="স্থায়ী ঠিকানা" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>গ্রাম:</label>
                            <input type="text" name="village" value="{{ old('village', $sr->village) }}" placeholder="গ্রাম" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ডাকঘর:</label>
                            <input type="text" name="post_office" value="{{ old('post_office', $sr->post_office) }}" placeholder="ডাকঘর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>থানা:</label>
                            <input type="text" name="police_station" value="{{ old('police_station', $sr->police_station) }}" placeholder="থানা" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>জেলা:</label>
                            <input type="text" name="district" value="{{ old('district', $sr->district) }}" placeholder="জেলা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের সম্পর্ক:</label>
                            <input type="text" name="guardian_relation" value="{{ old('guardian_relation', $sr->guardian_relation) }}" placeholder="সম্পর্ক" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের পেশা:</label>
                            <input type="text" name="guardian_occupation" value="{{ old('guardian_occupation', $sr->guardian_occupation) }}" placeholder="পেশা" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>অভিভাবকের মোবাইল:</label>
                            <input type="text" name="guardian_mobile" value="{{ old('guardian_mobile', $sr->guardian_mobile) }}" placeholder="মোবাইল নম্বর" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ছবি আপলোড করুন:</label>
                            <input type="file" name="photo" accept="image/*" class="form-input-styled" data-fouc>
                            <span class="form-text text-muted">গ্রহণযোগ্য ফরম্যাট: jpeg, png. সর্বোচ্চ 2Mb</span>
                            @if($sr->photo)
                                <img src="{{ asset($sr->photo) }}" alt="ছবি" style="width: 100px; margin-top: 10px;">
                            @endif
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
                            <label for="my_class_id">শ্রেণি: <span class="text-danger">*</span></label>
                            <select onchange="getClassSections(this.value)" required name="my_class_id" id="my_class_id" class="select-search form-control" data-placeholder="নির্বাচন করুন...">
                                <option value=""></option>
                                @foreach($my_classes as $c)
                                    <option {{ (old('my_class_id', $sr->my_class_id) == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>বিভাগ:</label>
                            <select name="department" class="select-search form-control" data-placeholder="বিভাগ নির্বাচন করুন">
                                <option value=""></option>
                                <option {{ (old('department', $sr->department) == 'noorani') ? 'selected' : '' }} value="noorani">নূরাণী</option>
                                <option {{ (old('department', $sr->department) == 'najera') ? 'selected' : '' }} value="najera">নাজেরা</option>
                                <option {{ (old('department', $sr->department) == 'hifz') ? 'selected' : '' }} value="hifz">হিফয</option>
                                <option {{ (old('department', $sr->department) == 'sunani') ? 'selected' : '' }} value="sunani">শুনানি</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ভর্তির নম্বর:</label>
                            <input type="text" name="adm_no" value="{{ old('adm_no', $sr->adm_no) }}" class="form-control" placeholder="ভর্তির নম্বর" required>
                        </div>
                    </div>
                </div>

                <!-- অন্যান্য শিক্ষাগত তথ্য -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ছাড়:</label>
                            <input type="number" name="discount" placeholder="ছাড়ের পরিমাণ" class="form-control" value="{{ old('discount', $sr->discount) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>বয়স:</label>
                            <input type="number" name="age" placeholder="বয়স" class="form-control" value="{{ old('age', $sr->age) }}">
                        </div>
                    </div>
                </div>

                <!-- পূর্ববর্তী প্রতিষ্ঠান -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ভর্তির তারিখ:</label>
                            <input type="text" name="admission_date" value="{{ old('admission_date', $sr->admission_date) }}" class="form-control date-pick" placeholder="তারিখ নির্বাচন করুন...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পূর্ববর্তী প্রতিষ্ঠানের নাম:</label>
                            <input type="text" name="previous_institution_name" value="{{ old('previous_institution_name', $sr->previous_institution_name) }}" class="form-control" placeholder="প্রতিষ্ঠানের নাম">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>প্রতিষ্ঠানের ঠিকানা:</label>
                            <input type="text" name="previous_institution_address" value="{{ old('previous_institution_address', $sr->previous_institution_address) }}" class="form-control" placeholder="ঠিকানা">
                        </div>
                    </div>
                </div>

                <!-- অতিরিক্ত -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পূর্ববর্তী শ্রেণি:</label>
                            <input type="text" name="prev_class_admitted" class="form-control" placeholder="শ্রেণি" value="{{ old('prev_class_admitted', $sr->prev_class_admitted) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পরীক্ষক:</label>
                            <input type="text" name="examiner" class="form-control" placeholder="পরীক্ষকের নাম" value="{{ old('examiner', $sr->examiner) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>পূর্ববর্তী ফলাফল:</label>
                            <input type="text" name="prev_exam_result" class="form-control" placeholder="ফলাফল" value="{{ old('prev_exam_result', $sr->prev_exam_result) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>আরবি ফলাফল:</label>
                            <input type="text" name="prev_arabic_result" class="form-control" placeholder="আরবি ফলাফল" value="{{ old('prev_arabic_result', $sr->prev_arabic_result) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>একাডেমিক ফলাফল:</label>
                            <input type="text" name="prev_academic_result" class="form-control" placeholder="একাডেমিক ফলাফল" value="{{ old('prev_academic_result', $sr->prev_academic_result) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>আবাসিক অবস্থা:</label>
                            <select name="is_residential" class="select-search form-control">
                                <option value="0" {{ (old('is_residential', $sr->is_residential) == 0) ? 'selected' : '' }}>অনাবাসিক</option>
                                <option value="1" {{ (old('is_residential', $sr->is_residential) == 1) ? 'selected' : '' }}>আবাসিক</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
