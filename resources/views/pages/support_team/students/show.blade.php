@extends('layouts.master')
@section('page_title', 'ছাত্র প্রোফাইল - ' . $sr->user->name)
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">ছাত্র প্রোফাইল: {{ $sr->user->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset($sr->photo ?? 'storage/default-user.png') }}" class="rounded-circle" style="height: 150px; width: 150px;" alt="ছাত্রের ছবি" onerror="this.onerror=null; this.src='{{ asset('storage/default-user.png') }}';">
                    <h5 class="mt-2">{{ $sr->user->name }}</h5>
                    <p>ভর্তি নম্বর: {{ $sr->adm_no }}</p>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        {{-- <button id="exportExcel" class="btn btn-success">এক্সেল আকারে রপ্তানি</button> --}}
                        {{-- <button id="exportPDF" class="btn btn-danger">পি.ডি.এফ আকারে রপ্তানি</button> --}}
                        <a href="{{route('student.print',['sr_id'=>$sr->id])}}" class="btn btn-primary">প্রোফাইল প্রিন্ট করুন</a> <!-- Print Button -->
                    </div>
                    <table class="table table-striped" id="studentProfileTable">
                        <thead>
                        <tr>
                            <th>ছাত্র</th>
                            <th>বিস্তারিত তথ্য</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-secondary">
                            <th colspan="2"><strong>ব্যক্তিগত তথ্য</strong></th>
                        </tr>
                        <tr><th>নাম</th><td>{{ $sr->user->name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>ইমেইল</th><td>{{ $sr->user->email ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>লিঙ্গ</th><td>{{ $sr->user->gender ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>ফোন</th><td>{{ $sr->user->phone ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>বিকল্প ফোন</th><td>{{ $sr->user->phone2 ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>জন্ম তারিখ</th><td>{{ $sr->dob ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পিতার নাম</th><td>{{ $sr->father_name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>মাতার নাম</th><td>{{ $sr->mother_name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>অভিভাবকের নাম</th><td>{{ $sr->guardian_name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>স্থায়ী ঠিকানা</th><td>{{ $sr->permanent_address ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>গ্রাম</th><td>{{ $sr->village ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>ডাকঘর</th><td>{{ $sr->post_office ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>থানা</th><td>{{ $sr->police_station ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>জেলা</th><td>{{ $sr->district ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>অভিভাবকের সম্পর্ক</th><td>{{ $sr->guardian_relation ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>অভিভাবকের পেশা</th><td>{{ $sr->guardian_occupation ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>অভিভাবকের মোবাইল</th><td>{{ $sr->guardian_mobile ?? 'প্রযোজ্য নয়' }}</td></tr>

                        <tr class="table-secondary">
                            <th colspan="2"><strong>শিক্ষাগত তথ্য</strong></th>
                        </tr>
                        <tr><th>ক্লাস</th><td>{{ $sr->my_class->name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>সেকশন</th><td>{{ $sr->section->name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>ভর্তি নম্বর</th><td>{{ $sr->adm_no ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>ভর্তি তারিখ</th><td>{{ $sr->admission_date ?? '' }}</td></tr>
                        <tr><th>ছাড়</th><td>{{ $sr->discount ?? '০' }}</td></tr>
                        <tr><th>বয়স</th><td>{{ $sr->age ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পূর্ববর্তী প্রতিষ্ঠান</th><td>{{ $sr->previous_institution_name ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পূর্ববর্তী ভর্তি ক্লাস</th><td>{{ $sr->prev_class_admitted ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পরীক্ষক</th><td>{{ $sr->examiner ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পূর্ববর্তী পরীক্ষার ফলাফল</th><td>{{ $sr->prev_exam_result ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>পূর্ববর্তী আরবি ফলাফল</th><td>{{ $sr->prev_arabic_result ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>বিভাগ</th><td>{{ $sr->department ?? 'প্রযোজ্য নয়' }}</td></tr>
                        <tr><th>বাসস্থান স্ট্যাটাস</th><td>{{ $sr->is_residential ? 'রেসিডেন্সিয়াল' : 'নন-রেসিডেন্সিয়াল' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        {{--
        // প্রিন্ট বাটনের জন্য জাভাস্ক্রিপ্ট (আপনি চাইলে আনকমেন্ট করে ব্যবহার করতে পারেন)
        // document.getElementById("printProfile").addEventListener("click", function () {
        //     let printWindow = window.open('', '', 'height=600,width=800');
        //     printWindow.document.write('<html><head><title>ছাত্র প্রোফাইল প্রিন্ট</title></head><body style="font-family: Arial, sans-serif; text-align: center;">');
        //
        //     // স্কুলের লোগো যোগ করা
        //     printWindow.document.write('<img src="{{ asset('logo.png') }}" style="width:100px; height:auto; margin-bottom: 10px;" alt="স্কুল লোগো">');
        //
        //     // স্কুলের তথ্য যোগ করা
        //     printWindow.document.write('<h2 style="margin: 5px 0;">মুসলিহুল উম্মাহ হিফজ মাদ্রাসা</h2>');
        //     printWindow.document.write('<p style="margin: 0;">১৪০ আজমপুর কাঁচা বাজার, দক্ষিণখান, উত্তরা, ঢাকা -১২৩০</p>');
        //     printWindow.document.write('<p style="margin: 0;">ফোন: ০১৯১৬৩৫৪৭৭০</p>');
        //
        //     // ছাত্রের তথ্যের টেবিল যোগ করা
        //     printWindow.document.write('<hr style="margin: 10px 0;">');
        //     printWindow.document.write(document.getElementById("studentProfileTable").outerHTML);
        //     printWindow.document.write('</body></html>');
        //
        //     printWindow.document.close();
        //     printWindow.print();
        // });
        --}}
    </script>

@endsection
