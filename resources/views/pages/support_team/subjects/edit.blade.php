@extends('layouts.master')
@section('page_title', 'বিষয় সংশোধন - '.$s->name. ' ('.$s->my_class->name.')')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">বিষয় সংশোধন - {{ $s->my_class->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-update" method="post" action="{{ route('subjects.update', $s->id) }}">
                        @csrf @method('PUT')

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">নাম <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ $s->name }}" required type="text" class="form-control" placeholder="বিষয়ের নাম">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">সংক্ষিপ্ত নাম</label>
                            <div class="col-lg-9">
                                <input name="slug" value="{{ $s->slug }}" type="text" class="form-control" placeholder="সংক্ষিপ্ত নাম">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">ক্লাস <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select required data-placeholder="ক্লাস নির্বাচন করুন" class="form-control select" name="my_class_id" id="my_class_id">
                                    @foreach($my_classes as $c)
                                        <option {{ $s->my_class_id == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">শিক্ষক</label>
                            <div class="col-lg-9">
                                <select data-placeholder="শিক্ষক নির্বাচন করুন" class="form-control select-search" name="teacher_id" id="teacher_id">
                                    <option value=""></option>
                                    @foreach($teachers as $t)
                                        <option {{ $s->teacher_id == $t->id ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                    @endforeach
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

    {{-- বিষয় সম্পাদনা সমাপ্ত --}}
@endsection
