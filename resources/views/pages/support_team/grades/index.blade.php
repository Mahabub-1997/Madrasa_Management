@extends('layouts.master')
@section('page_title', 'ফলাফল ব্যবস্থাপনা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">ফলাফল ব্যবস্থাপনা</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-grades" class="nav-link active" data-toggle="tab">গ্রেড সমূহ</a></li>
                <li class="nav-item"><a href="#new-grade" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> নতুন গ্রেড যোগ করুন</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-grades">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্রমিক</th>
                            <th>নাম</th>
                            <th>গ্রেড টাইপ</th>
                            <th>রেঞ্জ</th>
                            <th>মন্তব্য</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $gr)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gr->name }}</td>
                                <td>{{ $gr->class_type_id ? $class_types->where('id', $gr->class_type_id)->first()->name : ''}}</td>
                                <td>{{ $gr->mark_from.' - '.$gr->mark_to }}</td>
                                <td>{{ $gr->remark }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                @if(Qs::userIsTeamSA())
                                                    {{-- সম্পাদনা --}}
                                                    <a href="{{ route('grades.edit', $gr->id) }}" class="dropdown-item"><i class="icon-pencil"></i> সংশোধন</a>
                                                @endif
                                                @if(Qs::userIsSuperAdmin())
                                                    {{-- মুছে ফেলুন --}}
                                                    <a id="{{ $gr->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> মুছে ফেলুন</a>
                                                    <form method="post" id="item-delete-{{ $gr->id }}" action="{{ route('grades.destroy', $gr->id) }}" class="hidden">@csrf @method('delete')</form>
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

                <div class="tab-pane fade" id="new-grade">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                <span>আপনি যদি এমন একটি গ্রেড তৈরি করতে চান যা সকল শ্রেণীর জন্য প্রযোজ্য, তাহলে <strong>প্রযোজ্য নয়</strong> নির্বাচন করুন। অন্যথায়, সেই শ্রেণীর টাইপ নির্বাচন করুন যার জন্য গ্রেডটি প্রযোজ্য।</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="{{ route('grades.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">নাম <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control text-uppercase" placeholder="যেমন: A1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">গ্রেড টাইপ</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="class_type_id" id="class_type_id">
                                            <option value="">প্রযোজ্য নয়</option>
                                            @foreach($class_types as $ct)
                                                <option {{ old('class_type_id') == $ct->id ? 'selected' : '' }} value="{{ $ct->id }}">{{ $ct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">মার্ক শুরু <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input min="0" max="100" name="mark_from" value="{{ old('mark_from') }}" required type="number" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">মার্ক শেষ <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input min="0" max="100" name="mark_to" value="{{ old('mark_to') }}" required type="number" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="remark" class="col-lg-3 col-form-label font-weight-semibold">মন্তব্য</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="remark" id="remark">
                                            <option value="">মন্তব্য নির্বাচন করুন...</option>
                                            @foreach(Mk::getRemarks() as $rem)
                                                <option {{ old('remark') == $rem ? 'selected' : '' }} value="{{ $rem }}">{{ $rem }}</option>
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
        </div>
    </div>

    {{--গ্রেড তালিকা শেষ--}}

@endsection
