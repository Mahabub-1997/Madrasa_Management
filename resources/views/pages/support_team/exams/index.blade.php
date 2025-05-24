@extends('layouts.master')
@section('page_title', 'পরীক্ষা পরিচালনা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">পরীক্ষা পরিচালনা</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-exams" class="nav-link active" data-toggle="tab">পরীক্ষা পরিচালনা</a></li>
                <li class="nav-item"><a href="#new-exam" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> নতুন পরীক্ষা যোগ করুন</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-exams">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্র. নং</th>
                            <th>নাম</th>
                            <th>টার্ম</th>
                            <th>সেশন</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $ex)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ex->name }}</td>
                                <td>{{ 'টার্ম '.$ex->term }}</td>
                                <td>{{ $ex->year }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                @if(Qs::userIsTeamSA())
                                                    {{--সম্পাদনা--}}
                                                    <a href="{{ route('exams.edit', $ex->id) }}" class="dropdown-item"><i class="icon-pencil"></i> সংশোধন</a>
                                                @endif
                                                @if(Qs::userIsSuperAdmin())
                                                    {{--মুছে ফেলুন--}}
                                                    <a id="{{ $ex->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> মুছে ফেলুন</a>
                                                    <form method="post" id="item-delete-{{ $ex->id }}" action="{{ route('exams.destroy', $ex->id) }}" class="hidden">@csrf @method('delete')</form>
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

                <div class="tab-pane fade" id="new-exam">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                <span>আপনি বর্তমান সেশনের জন্য একটি পরীক্ষা তৈরি করছেন <strong>{{ Qs::getSetting('current_session') }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="{{ route('exams.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">নাম <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="পরীক্ষার নাম">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="term" class="col-lg-3 col-form-label font-weight-semibold">টার্ম</label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="টার্ম নির্বাচন করুন" class="form-control select-search" name="term" id="term">
                                            <option {{ old('term') == 1 ? 'selected' : '' }} value="1">প্রথম টার্ম</option>
                                            <option {{ old('term') == 2 ? 'selected' : '' }} value="2">দ্বিতীয় টার্ম</option>
                                            <option {{ old('term') == 3 ? 'selected' : '' }} value="3">তৃতীয় টার্ম</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">ফর্ম জমা দিন <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--পরীক্ষা তালিকা শেষ--}}
@endsection
