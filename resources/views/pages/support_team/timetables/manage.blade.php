@extends('layouts.master')
@section('page_title', 'সময়সূচি ব্যবস্থাপনা')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">{{ $ttr->name.' ('.$my_class->name.')'.' '.$ttr->year }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#manage-ts" class="nav-link active" data-toggle="tab">সময় স্লট ব্যবস্থাপনা</a></li>
                <li class="nav-item"><a href="#add-sub" class="nav-link" data-toggle="tab">বিষয় যুক্ত করুন</a></li>
                <li class="nav-item"><a href="#edit-subs" class="nav-link" data-toggle="tab">বিষয় সম্পাদনা করুন</a></li>
                <li class="nav-item">
                    <a target="_blank" href="{{ route('ttr.show', $ttr->id) }}" class="nav-link">সময়সূচি দেখুন</a>
                </li>
            </ul>

            <div class="tab-content">
                {{-- সময় স্লট যুক্ত করুন --}}
                @include('pages.support_team.timetables.time_slots.index')

                {{-- বিষয় যুক্ত করুন --}}
                @include('pages.support_team.timetables.subjects.add')

                {{-- বিষয় সম্পাদনা করুন --}}
                @include('pages.support_team.timetables.subjects.edit')
            </div>
        </div>
    </div>

    {{-- সময়সূচি ব্যবস্থাপনার সমাপ্তি --}}

@endsection
