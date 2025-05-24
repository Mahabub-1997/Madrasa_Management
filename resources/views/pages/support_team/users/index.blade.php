@extends('layouts.master')
@section('page_title', 'ইউজার ম্যানেজমেন্ট')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">ইউজার ম্যানেজমেন্ট</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">নতুন ইউজার তৈরি করুন</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ইউজারসমূহ পরিচালনা করুন</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($user_types as $ut)
                            <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item" data-toggle="tab">{{ $ut->name }}-গণ</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-user">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" action="{{ route('users.store') }}" data-fouc>
                        @csrf
                        <h6>ব্যক্তিগত তথ্য</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="user_type"> ইউজার নির্বাচন করুন: <span class="text-danger">*</span></label>
                                        <select required data-placeholder="ইউজার নির্বাচন করুন" class="form-control select" name="user_type" id="user_type">
                                            @foreach($user_types as $ut)
                                                <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>পুরো নাম: <span class="text-danger">*</span></label>
                                        <input value="{{ old('name') }}" required type="text" name="name" placeholder="পুরো নাম লিখুন" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ঠিকানা: <span class="text-danger">*</span></label>
                                        <input value="{{ old('address') }}" class="form-control" placeholder="ঠিকানা লিখুন" name="address" type="text" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ইমেইল:</label>
                                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ফোন:</label>
                                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+8801XXXXXXXXX">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">পাসওয়ার্ড:</label>
                                        <input id="password" type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>চাকরিতে যোগদানের তারিখ:</label>
                                        <input autocomplete="off" name="emp_date" value="{{ old('emp_date') }}" type="text" class="form-control date-pick" placeholder="তারিখ নির্বাচন করুন...">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">লিঙ্গ: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="নির্বাচন করুন...">
                                            <option value=""></option>
                                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">পুরুষ</option>
                                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">মহিলা</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                @foreach($user_types as $ut)
                    <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>ক্রমিক</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ফোন</th>
                                <th>ইমেইল</th>
                                <th>অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users->where('user_type', $ut->title) as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="ছবি"></td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-eye"></i> প্রোফাইল দেখুন</a>
                                                    <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> সম্পাদনা করুন</a>
                                                    @if(Qs::userIsSuperAdmin())
                                                        <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> পাসওয়ার্ড রিসেট করুন</a>
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> মুছে ফেলুন</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
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
