@extends('layouts.master')
@section('page_title', 'My Dashboard')

@section('content')
    <h2>স্বাগতম {{ Auth::user()->name }}। এটি আপনার ড্যাশবোর্ড</h2>
    @endsection
