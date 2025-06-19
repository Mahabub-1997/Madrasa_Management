<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info text-center">
            <span>আপনি নতুন সময়সীমা (Time Slots) যোগ করতে পারেন অথবা অন্য সময়সূচির সময়সীমা ব্যবহার করতে পারেন।
                <strong>নোট:</strong> বিদ্যমান সময়সীমা ব্যবহার করলে বর্তমান সময়সূচি রিসেট হবে।
            </span>
        </div>
    </div>

    {{-- নতুন সময়সীমা যোগ করুন --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline bg-danger">
                <h6 class="font-weight-bold card-title">নতুন সময়সীমা যোগ করুন</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body collapse">
                <div class="col-md-12">
                    <form data-reload="#time_slots_table" class="ajax-store" method="post" action="{{ route('ts.store') }}">
                        @csrf
                        <input name="ttr_id" value="{{ $ttr->id }}" type="hidden">

                        {{-- শুরু সময় --}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">শুরু সময় <span class="text-danger">*</span></label>

                            <div class="col-lg-3">
                                <select required class="select-search form-control" name="hour_from" id="hour_from">
                                    <option value=""></option>
                                    @for($t=1; $t<=12; $t++)
                                        <option {{ old('hour_from') == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select required class="select-search form-control" name="min_from" id="min_from">
                                    <option value=""></option>
                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    @for($t=10; $t<=55; $t+=5)
                                        <option {{ old('min_from') == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select required class="select form-control" name="meridian_from" id="meridian_from">
                                    <option value=""></option>
                                    <option {{ old('meridian_from') == 'AM' ? 'selected' : '' }} value="AM">AM</option>
                                    <option {{ old('meridian_from') == 'PM' ? 'selected' : '' }} value="PM">PM</option>
                                </select>
                            </div>
                        </div>

                        {{-- শেষ সময় --}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">শেষ সময় <span class="text-danger">*</span></label>

                            <div class="col-lg-3">
                                <select required class="select-search form-control" name="hour_to" id="hour_to">
                                    <option value=""></option>
                                    @for($t=1; $t<=12; $t++)
                                        <option {{ old('hour_to') == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select required class="select-search form-control" name="min_to" id="min_to">
                                    <option value=""></option>
                                    <option value="00">00</option>
                                    <option value="05">05</option>
                                    @for($t=10; $t<=55; $t+=5)
                                        <option {{ old('min_to') == $t ? 'selected' : '' }} value="{{ $t }}">{{ $t }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select required class="select form-control" name="meridian_to" id="meridian_to">
                                    <option value=""></option>
                                    <option {{ old('meridian_to') == 'AM' ? 'selected' : '' }} value="AM">AM</option>
                                    <option {{ old('meridian_to') == 'PM' ? 'selected' : '' }} value="PM">PM</option>
                                </select>
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

    {{-- বিদ্যমান সময়সীমা ব্যবহার করুন --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline bg-dark">
                <h6 class="font-weight-bold card-title">বিদ্যমান সময়সীমা ব্যবহার করুন</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body collapse">
                <div class="col-md-12">
                    <form method="post" action="{{ route('ts.use', $ttr->id) }}">
                        @csrf

                        <div class="form-group">
                            <label for="ttr_id" class="col-form-label-lg font-weight-semibold mb-lg-2">একটি বিদ্যমান সময়সীমা নির্বাচন করুন <span class="text-danger">*</span></label>

                            <div class="col-lg-8">
                                <select id="ttr_id" required class="select-search form-control-lg" name="ttr_id">
                                    <option value=""></option>
                                    @foreach($ts_existing as $ttr_ts)
                                        <option value="{{ $ttr_ts->id }}">{{ $ttr_ts->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-lg btn-success">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
