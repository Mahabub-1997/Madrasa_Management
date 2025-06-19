@extends('layouts.master')
@section('page_title', 'মাসিক ফি-সমূহ')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">মাসিক ফি-সমূহ</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('payments.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="admission_fee" class="col-lg-3 col-form-label font-weight-semibold">ভর্তি ফি <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" value="{{ $p->admission_fee }}" required name="admission_fee" id="admission_fee" type="number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tution_fee" class="col-lg-3 col-form-label font-weight-semibold">বেতন <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" value="{{ $p->tution_fee }}" required name="tution_fee" id="tution_fee" type="number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="khoraki" class="col-lg-3 col-form-label font-weight-semibold">খোরাকি <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" value="{{ $p->khoraki }}" required name="khoraki" id="khoraki" type="number">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
