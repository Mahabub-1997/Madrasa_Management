@extends('layouts.master')
@section('page_title', 'সময় স্লট সংশোধন করুন')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="font-weight-bold card-title">সময় স্লট সংশোধন করুন</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="col-md-6">
                <form method="post" action="{{ route('ts.update', $tms->id) }}">
                    @csrf @method('PUT')
                    <input name="ttr_id" value="{{ $tms->ttr_id }}" type="hidden">

                    {{-- শুরু সময় --}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">শুরু সময় <span class="text-danger">*</span></label>

                        <div class="col-lg-3">
                            <select data-placeholder="ঘণ্টা" required class="select-search form-control" name="hour_from" id="hour_from">
                                <option value=""></option>
                                @for($t=1; $t<=12; $t++)
                                    <option {{ $tms->hour_from == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select data-placeholder="মিনিট" required class="select-search form-control" name="min_from" id="min_from">
                                <option value=""></option>
                                <option value="00">00</option>
                                <option value="05">05</option>
                                @for($t=10; $t<=55; $t+=5)
                                    <option {{ $tms->min_from == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select data-placeholder="AM/PM" required class="select form-control" name="meridian_from" id="meridian_from">
                                <option value=""></option>
                                <option {{ $tms->meridian_from == 'AM' ? 'selected' : '' }} value="AM">AM</option>
                                <option {{ $tms->meridian_from == 'PM' ? 'selected' : '' }} value="PM">PM</option>
                            </select>
                        </div>
                    </div>

                    {{-- শেষ সময় --}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">শেষ সময় <span class="text-danger">*</span></label>

                        <div class="col-lg-3">
                            <select data-placeholder="ঘণ্টা" required class="select-search form-control" name="hour_to" id="hour_to">
                                <option value=""></option>
                                @for($t=1; $t<=12; $t++)
                                    <option {{ $tms->hour_to == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select data-placeholder="মিনিট" required class="select-search form-control" name="min_to" id="min_to">
                                <option value=""></option>
                                <option value="00">00</option>
                                <option value="05">05</option>
                                @for($t=10; $t<=55; $t+=5)
                                    <option {{ $tms->min_to == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <select data-placeholder="AM/PM" required class="select form-control" name="meridian_to" id="meridian_to">
                                <option value=""></option>
                                <option {{ $tms->meridian_to == 'AM' ? 'selected' : '' }} value="AM">AM</option>
                                <option {{ $tms->meridian_to == 'PM' ? 'selected' : '' }} value="PM">PM</option>
                            </select>
                        </div>
                    </div>

                    {{-- সাবমিট --}}
                    <div class="text-right">
                        <button id="ajax-btn" type="submit" class="btn btn-primary">সাবমিট করুন <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
