@extends('layouts.master')
@section('page_title', 'নোটিশ বোর্ড')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">নোটিশ বোর্ড</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-notices" class="nav-link active" data-toggle="tab">নোটিশ পরিচালনা</a></li>
                <li class="nav-item"><a href="#add-notices" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>নোটিশ তৈরি</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-notices">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>ক্রমিক </th>
                            <th>শিরোনাম</th>
                            <th>বিবরণ</th>
                            <th>শুরুর তারিখ</th>
                            <th>শেষ তারিখ</th>
{{--                            <th>অগ্রাধিকার</th>--}}
                            <th>অবস্থা</th>
                            <th>নির্দেশনা</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notices as $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $val->title }}</td>
                                <td>{{ $val->description }}</td>
                                <td>{{ $val->start_date }}</td>
                                <td>{{ $val->end_date }}</td>
{{--                                <td>{{ $val->priority }}</td>--}}
                                <td>{{ $val->status=='active'?'চলমান ':'বন্ধ' }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                {{--Edit--}}
                                                @if(Qs::userIsTeamSA())
                                                    <a href="{{ route('notice_board.edit', $val->id) }}" class="dropdown-item">
                                                        <i class="icon-pencil"></i> সংশোধন
                                                    </a>
                                                @endif
                                                {{--Delete--}}
                                                @if(Qs::userIsSuperAdmin())
                                                    <a id="delete-{{ $val->id }}" onclick="confirmDelete('{{ $val->id }}')" href="#" class="dropdown-item">
                                                        <i class="icon-trash"></i> মুছে ফেলুন
                                                    </a>
                                                    <form method="post" id="item-delete-{{ $val->id }}" action="{{ route('notice_board.destroy', $val->id) }}" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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

                <div class="tab-pane fade" id="add-notices">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                <span>মাদ্রাসার গুরুত্বপূর্ণ নোটিশসমূহ এখানে প্রকাশিত হবে শিক্ষার্থী ও অভিভাবকদের জন্য। </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form class="" method="post" action="{{ route('notice_board.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        শিরোনাম <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="title" value="{{ old('title') }}" required type="text" class="form-control" placeholder="নোটিশের শিরোনাম">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        বিবরণ
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="description" class="form-control" placeholder="নোটিশের বিবরণ">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        শুরুর তারিখ <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="start_date" value="{{ old('start_date') }}" required type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        শেষ তারিখ <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input name="end_date" value="{{ old('end_date') }}" required type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        অগ্রাধিকার <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Priority" class="form-control select" name="priority" id="priority">
                                            <option {{ old('priority') == 'important' ? 'selected' : '' }} value="important">গুরুত্বপূর্ণ</option>
                                            <option {{ old('priority') == 'normal' ? 'selected' : '' }} value="normal">সাধারণ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        অবস্থা
                                    </label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select status" class="form-control select" name="status" id="status">
                                            <option {{ old('status') == 'active' ? 'selected' : '' }} value="active">সক্রিয়</option>
                                            <option {{ old('status') == 'inactive' ? 'selected' : '' }} value="inactive">বন্ধ </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">জমা দিন <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
