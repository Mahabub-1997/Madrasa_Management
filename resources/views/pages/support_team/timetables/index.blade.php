@extends('layouts.master')
@section('page_title', 'সময়সূচি ব্যবস্থাপনা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">সময়সূচি ব্যবস্থাপনা</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                @if(Qs::userIsTeamSA())
                    <li class="nav-item"><a href="#add-tt" class="nav-link active" data-toggle="tab">নতুন সময়সূচি যুক্ত করুন</a></li>
                @endif
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">সময়সূচি দেখুন</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($my_classes as $mc)
                            <a href="#ttr{{ $mc->id }}" class="dropdown-item" data-toggle="tab">{{ $mc->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">

                @if(Qs::userIsTeamSA())
                    <div class="tab-pane fade show active" id="add-tt">
                        <div class="col-md-8">
                            <form class="ajax-store" method="post" action="{{ route('ttr.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">নাম <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="সময়সূচির নাম লিখুন">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">শ্রেণি <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="শ্রেণি নির্বাচন করুন" class="form-control select" name="my_class_id" id="my_class_id">
                                            @foreach($my_classes as $mc)
                                                <option {{ old('my_class_id') == $mc->id ? 'selected' : '' }} value="{{ $mc->id }}">{{ $mc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_id" class="col-lg-3 col-form-label font-weight-semibold">ধরন (শ্রেণি বা পরীক্ষা)</label>
                                    <div class="col-lg-9">
                                        <select class="select form-control" name="exam_id" id="exam_id">
                                            <option value="">শ্রেণির সময়সূচি</option>
                                            @foreach($exams as $ex)
                                                <option {{ old('exam_id') == $ex->id ? 'selected' : '' }} value="{{ $ex->id }}">{{ $ex->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @foreach($my_classes as $mc)
                    <div class="tab-pane fade" id="ttr{{ $mc->id }}">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>ক্রমিক</th>
                                <th>নাম</th>
                                <th>শ্রেণি</th>
                                <th>ধরন</th>
                                <th>বছর</th>
                                <th>নির্দেশনা</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tt_records->where('my_class_id', $mc->id) as $ttr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ttr->name }}</td>
                                    <td>{{ $ttr->my_class->name }}</td>
                                    <td>{{ ($ttr->exam_id) ? $ttr->exam->name : 'শ্রেণির সময়সূচি' }}</td>
                                    <td>{{ $ttr->year }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{ route('ttr.show', $ttr->id) }}" class="dropdown-item"><i class="icon-eye"></i> দেখুন</a>

                                                    @if(Qs::userIsTeamSA())
                                                        <a href="{{ route('ttr.manage', $ttr->id) }}" class="dropdown-item"><i class="icon-plus-circle2"></i> পরিচালনা করুন</a>
                                                        <a href="{{ route('ttr.edit', $ttr->id) }}" class="dropdown-item"><i class="icon-pencil"></i> সংশোধন </a>
                                                    @endif

                                                    @if(Qs::userIsSuperAdmin())
                                                        <a id="{{ $ttr->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> মুছুন</a>
                                                        <form method="post" id="item-delete-{{ $ttr->id }}" action="{{ route('ttr.destroy', $ttr->id) }}" class="hidden">@csrf @method('delete')</form>
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
                @endforeach

            </div>
        </div>
    </div>

@endsection
