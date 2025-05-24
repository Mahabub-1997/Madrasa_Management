<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ছাত্র প্রোফাইল - {{ $sr->user->name }}</title>
    <style>
        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm;
            }

            body {
                font-family: Arial, sans-serif;
                margin: 0;
                font-size: 14px;
                text-align: left;
            }

            .container {
                width: 100%;
                padding: 20px;
            }

            .header-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 15px;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            .student-info {
                display: flex;
                align-items: center;
            }

            .student-photo {
                height: 100px;
                width: 100px;
                border-radius: 50%;
                margin-right: 15px;
            }

            .content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .column {
                width: 48%;
                padding: 10px;
                box-sizing: border-box;
            }

            .details-section {
                margin-top: 15px;
            }

            .details-section h3 {
                background-color: #f0f0f0;
                padding: 5px;
                font-size: 16px;
                margin-bottom: 5px;
            }

            .details strong {
                display: inline-block;
                width: 180px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-container">
        <div class="student-info">
            <img src="{{ asset($sr->photo) }}" class="student-photo" style="max-height: 200px" alt="ছাত্রের ছবি">
            <div>
                <h2>{{ $sr->user->name }}</h2>
                <p><strong>ভর্তি নম্বর:</strong> {{ $sr->adm_no }}</p>
            </div>
        </div>
        <div style="text-align: right; padding-right: 10px; margin-right: 10px;">
            <h2>মুসলিহুল উম্মাহ হিফজ মাদ্রাসা</h2>
            <p>১৪০ আজমপুর কাঁচা বাজার, দক্ষিণখান, উত্তরা, ঢাকা -১২৩০</p>
            <p><strong>ফোন:</strong> ০১৯১৬৩৫৪৭৭০</p>
        </div>
    </div>

    <div class="content">
        <div class="column">
            <div class="details-section">
                <h3>ব্যক্তিগত তথ্য</h3>
                <p class="details"><strong>নাম:</strong> {{ $sr->user->name ?? 'N/A' }}</p>
                <p class="details"><strong>ইমেইল:</strong> {{ $sr->user->email ?? 'N/A' }}</p>
                <p class="details"><strong>লিঙ্গ:</strong> {{ $sr->user->gender ?? 'N/A' }}</p>
                <p class="details"><strong>ফোন:</strong> {{ $sr->user->phone ?? 'N/A' }}</p>
                <p class="details"><strong>জন্ম তারিখ:</strong> {{ $sr->dob ?? 'N/A' }}</p>
                <p class="details"><strong>বয়স:</strong> {{ $sr->age ?? 'N/A' }}</p>
                <p class="details"><strong>বিকল্প ফোন:</strong> {{ $sr->user->phone2 ?? 'N/A' }}</p>
            </div>

            <div class="details-section">
                <h3>অভিভাবকের তথ্য</h3>
                <p class="details"><strong>পিতার নাম:</strong> {{ $sr->father_name ?? 'N/A' }}</p>
                <p class="details"><strong>মাতার নাম:</strong> {{ $sr->mother_name ?? 'N/A' }}</p>
                <p class="details"><strong>অভিভাবকের নাম:</strong> {{ $sr->guardian_name ?? 'N/A' }}</p>
                <p class="details"><strong>সম্পর্ক:</strong> {{ $sr->guardian_relation ?? 'N/A' }}</p>
                <p class="details"><strong>পেশা:</strong> {{ $sr->guardian_occupation ?? 'N/A' }}</p>
                <p class="details"><strong>মোবাইল:</strong> {{ $sr->guardian_mobile ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="column">
            <div class="details-section">
                <h3>একাডেমিক তথ্য</h3>
                <p class="details"><strong>ভর্তি নম্বর:</strong> {{ $sr->adm_no ?? 'N/A' }}</p>
                <p class="details"><strong>শ্রেণি:</strong> {{ $sr->my_class->name ?? 'N/A' }}</p>
                <p class="details"><strong>সেকশন:</strong> {{ $sr->section->name ?? 'N/A' }}</p>
                <p class="details"><strong>ভর্তির তারিখ:</strong> {{ $sr->admission_date ?? 'N/A' }}</p>
                <p class="details"><strong>ছাড়:</strong> {{ $sr->discount ?? '0' }}</p>
                <p class="details"><strong>পূর্ববর্তী প্রতিষ্ঠান:</strong> {{ $sr->previous_institution_name ?? 'N/A' }}</p>
                <p class="details"><strong>পূর্ববর্তী শ্রেণি:</strong> {{ $sr->prev_class_admitted ?? 'N/A' }}</p>
                <p class="details"><strong>পরীক্ষক:</strong> {{ $sr->examiner ?? 'N/A' }}</p>
            </div>

            <div class="details-section">
                <h3>ঠিকানা</h3>
                <p class="details"><strong>স্থায়ী ঠিকানা:</strong> {{ $sr->permanent_address ?? 'N/A' }}</p>
                <p class="details"><strong>গ্রাম:</strong> {{ $sr->village ?? 'N/A' }}</p>
                <p class="details"><strong>ডাকঘর:</strong> {{ $sr->post_office ?? 'N/A' }}</p>
                <p class="details"><strong>থানা:</strong> {{ $sr->police_station ?? 'N/A' }}</p>
                <p class="details"><strong>জেলা:</strong> {{ $sr->district ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>

</body>
</html>
