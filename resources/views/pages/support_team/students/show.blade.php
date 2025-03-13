@extends('layouts.master')
@section('page_title', 'Student Profile - ' . $sr->user->name)
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Student Profile: {{ $sr->user->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset($sr->photo ?? 'storage/default-user.png') }}" class="rounded-circle" style="height: 150px; width: 150px;" alt="Student Photo" onerror="this.onerror=null; this.src='{{ asset('storage/default-user.png') }}';">
                    <h5 class="mt-2">{{ $sr->user->name }}</h5>
                    <p>Admission No: {{ $sr->adm_no }}</p>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped" id="studentProfileTable">
                        <thead>
                        <tr>
                            <th colspan="2">Student Profile: {{ $sr->user->name }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-secondary">
                            <th colspan="2">Personal Information</th>
                        </tr>
                        <tr><th>Email</th><td>{{ $sr->user->email ?? 'N/A' }}</td></tr>
                        <tr><th>Gender</th><td>{{ $sr->user->gender ?? 'N/A' }}</td></tr>
                        <tr><th>Phone</th><td>{{ $sr->user->phone ?? 'N/A' }}</td></tr>
                        <tr><th>Alternate Phone</th><td>{{ $sr->user->phone2 ?? 'N/A' }}</td></tr>
                        <tr><th>Date of Birth</th><td>{{ $sr->dob ?? 'N/A' }}</td></tr>
                        <tr><th>Father's Name</th><td>{{ $sr->father_name ?? 'N/A' }}</td></tr>
                        <tr><th>Mother's Name</th><td>{{ $sr->mother_name ?? 'N/A' }}</td></tr>
                        <tr><th>Guardian Name</th><td>{{ $sr->guardian_name ?? 'N/A' }}</td></tr>
                        <tr><th>Permanent Address</th><td>{{ $sr->permanent_address ?? 'N/A' }}</td></tr>
                        <tr><th>Village</th><td>{{ $sr->village ?? 'N/A' }}</td></tr>
                        <tr><th>Post Office</th><td>{{ $sr->post_office ?? 'N/A' }}</td></tr>
                        <tr><th>Police Station</th><td>{{ $sr->police_station ?? 'N/A' }}</td></tr>
                        <tr><th>District</th><td>{{ $sr->district ?? 'N/A' }}</td></tr>
                        <tr><th>Guardian Relation</th><td>{{ $sr->guardian_relation ?? 'N/A' }}</td></tr>
                        <tr><th>Guardian Occupation</th><td>{{ $sr->guardian_occupation ?? 'N/A' }}</td></tr>
                        <tr><th>Guardian Mobile</th><td>{{ $sr->guardian_mobile ?? 'N/A' }}</td></tr>

                        <tr class="table-secondary">
                            <th colspan="2">Academic Information</th>
                        </tr>
                        <tr><th>Class</th><td>{{ $sr->my_class->name ?? 'N/A' }}</td></tr>
                        <tr><th>Section</th><td>{{ $sr->section->name ?? 'N/A' }}</td></tr>
                        <tr><th>Admission Date</th><td>{{ $sr->admission_date ?? 'N/A' }}</td></tr>
                        <tr><th>Discount</th><td>{{ $sr->discount ?? '0' }}</td></tr>
                        <tr><th>Age</th><td>{{ $sr->age ?? 'N/A' }}</td></tr>
                        <tr><th>Previous Institution</th><td>{{ $sr->previous_institution_name ?? 'N/A' }}</td></tr>
                        <tr><th>Previous Class Admitted</th><td>{{ $sr->prev_class_admitted ?? 'N/A' }}</td></tr>
                        <tr><th>Examiner</th><td>{{ $sr->examiner ?? 'N/A' }}</td></tr>
                        <tr><th>Previous Exam Result</th><td>{{ $sr->prev_exam_result ?? 'N/A' }}</td></tr>
                        <tr><th>Previous Arabic Result</th><td>{{ $sr->prev_arabic_result ?? 'N/A' }}</td></tr>
                        <tr><th>Department</th><td>{{ $sr->department ?? 'N/A' }}</td></tr>
                        <tr><th>Residential Status</th><td>{{ $sr->is_residential ? 'Residential' : 'Non Residential' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#studentProfileTable').DataTable({
                paging: false,         // Disable pagination (all data on one page)
                searching: false,      // Remove the search box
                dom: 'Brt',            // Only show export buttons and the table
                buttons: [
                    {
                        extend: 'excelHtml5',   // Excel export button
                        title: 'Student Profile - {{ $sr->user->name }}',
                    },
                    {
                        extend: 'pdfHtml5',     // PDF export button
                        title: 'Student Profile - {{ $sr->user->name }}',
                        orientation: 'portrait',
                        pageSize: 'A4',
                    }
                ]
            });
        });
    </script>
@endsection
