@extends('layouts.master')
@section('page_title', 'পরীক্ষা সংশোধন - '.$ex->name. ' ('.$ex->year.')')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">পরীক্ষা সংশোধন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('exams.update', $ex->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">নাম <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ $ex->name }}" required type="text" class="form-control" placeholder="পরীক্ষার নাম">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="term" class="col-lg-3 col-form-label font-weight-semibold">টার্ম</label>
                            <div class="col-lg-9">
                                <select data-placeholder="টার্ম নির্বাচন করুন" class="form-control select-search" name="term" id="term">
                                    <option {{ $ex->term == 1 ? 'selected' : '' }} value="1">প্রথম টার্ম</option>
                                    <option {{ $ex->term == 2 ? 'selected' : '' }} value="2">দ্বিতীয় টার্ম</option>
                                    <option {{ $ex->term == 3 ? 'selected' : '' }} value="3">তৃতীয় টার্ম</option>
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

    {{--পরীক্ষা সম্পাদনা শেষ--}}

@endsection
