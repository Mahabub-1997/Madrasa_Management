@extends('Frontend.Layouts.master')
@section('title')
    Muslihul Ummah Hifz Madrasah
@endsection
@section('links')
    <link href="{{asset('/')}}frontend/css/bootstrap.css" rel="stylesheet">
    <!-- DL Menu CSS -->
    <link href="{{asset('/')}}frontend/js/dl-menu/component.css" rel="stylesheet">
    <!-- SLICK SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}frontend/css/slick.css"/>
    <!-- Font Awesome StyleSheet CSS -->
    <link href="{{asset('/')}}frontend/css/font-awesome.min.css" rel="stylesheet">
    <!-- Font Awesome StyleSheet CSS -->
    <link href="{{asset('/')}}frontend/css/svg.css" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="{{asset('/')}}frontend/css/prettyPhoto.css" rel="stylesheet">
    <!-- Shortcodes CSS -->
    <link href="{{asset('/')}}frontend/css/shortcodes.css" rel="stylesheet">
    <!-- Widget CSS -->
    <link href="{{asset('/')}}frontend/css/widget.css" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="{{asset('/')}}frontend/css/typography.css" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{asset('/')}}frontend/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="{{asset('/')}}frontend/css/color.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{asset('/')}}frontend/css/responsive.css" rel="stylesheet">

    <style>
        /* For small screens, make table scrollable horizontally */
        .table-responsive {
            overflow-x: auto;
        }

        /* Mobile version adjustments */
        @media (max-width: 768px) {
            table {
                font-size: 14px; /* smaller font on mobile */
            }

            th, td {
                white-space: nowrap; /* prevent wrapping */
                padding: 10px; /* better spacing */
            }
        }

        /* For very small screens (below 480px), further tweak */
        @media (max-width: 480px) {
            table {
                font-size: 12px; /* even smaller font */
            }

            th, td {
                padding: 8px; /* smaller padding */
            }

            td {
                display: block; /* Stack each cell */
                width: 100%; /* full-width block display */
                text-align: left;
                margin-bottom: 10px; /* spacing between rows */
            }

            th {
                display: none; /* Hide table headers on very small screens */
            }

            /* Show Title in bold and as labels above the description */
            td:before {
                content: attr(data-title); /* Add a custom title before each description */
                font-weight: bold;
                display: block;
                margin-top: 10px;
            }
        }

        /* Optional: Customize the first column for mobile */
        td:first-child {
            font-weight: bold;
        }
    </style>




@endsection

@section('content')
    <!--Banner Wrap Start-->
    <div class="iner_banner">
        <div class="container">
            <h5 class="admissionTerms">Admission Terms and Conditions</h5>
            <div class="banner_iner_capstion">
                <ul>
                    <li><a class="admissionTermsHome" href="#">Home</a></li>
                    <li><a class="admissionTerms" href="#">Admission Terms and Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--Banner Wrap End-->
    <div class="col-md-8 mx-auto mt-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-3">শিরোনাম</th>
                    <th class="col-md-9">বর্ণনা</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ডকুমেন্ট সংগ্রহ</td>
                    <td>
                        - জন্ম সনদপত্র (বয়স যাচাইয়ের জন্য)।<br>
                        - পিতামাতা/অভিভাবকের জাতীয় পরিচয়পত্রের কপি।<br>
                        - পাসপোর্ট সাইজের ছবি (৪-৬ কপি)।<br>
                        - পূর্ববর্তী শিক্ষাগত সনদপত্র (যদি উচ্চতর স্তরে ভর্তি হয়)।<br>
                        - মেডিকেল সনদপত্র (যদি মাদ্রাসার দ্বারা প্রয়োজন হয়)।
                    </td>
                </tr>
                <tr>
                    <td>ফি পরিশোধ</td>
                    <td>
                        - নির্ধারিত ভর্তি ফি পরিশোধ করুন (যদি প্রযোজ্য হয়) মাদ্রাসার অফিসে অথবা অনলাইন ব্যাংকিংয়ের মাধ্যমে (যদি উপলব্ধ থাকে)।<br>
                        - পরিশোধের রশিদ সংগ্রহ করুন প্রমাণ হিসেবে।
                    </td>
                </tr>
                <tr>
                    <td>ভর্তি পরীক্ষা/সাক্ষাৎকার</td>
                    <td>
                        - ভর্তি পরীক্ষায় অংশগ্রহণ করুন, যা অন্তর্ভুক্ত করতে পারে:<br>
                        &nbsp;&nbsp;• মৌলিক কুরআন তেলাওয়াতের দক্ষতা।<br>
                        &nbsp;&nbsp;• সাধারণ জ্ঞান অথবা শিক্ষাগত প্রশ্নাবলি (উচ্চতর স্তরের জন্য)।<br>
                        &nbsp;&nbsp;• শৃঙ্খলা এবং প্রস্তুতি মূল্যায়ন করার জন্য মৌখিক সাক্ষাৎকার।
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{asset('/')}}frontend/js/admission.terms.localization.js"></script>

    <script src="{{asset('/')}}frontend/js/localization.js"></script>
    <!--iqoniq Wrapper End-->
    <!--Javascript Library-->
    <script src="{{asset('/')}}frontend/js/jquery.js"></script>
    <!--Bootstrap core JavaScript-->
    <script src="{{asset('/')}}frontend/js/bootstrap.min.js"></script>
    <!--SLICK SLIDER JavaScript-->
    <script src="{{asset('/')}}frontend/js/slick.min.js"></script>
    <!--Dl Menu Script-->
    <script src="{{asset('/')}}frontend/js/dl-menu/modernizr.custom.js"></script>
    <script src="{{asset('/')}}frontend/js/dl-menu/jquery.dlmenu.js"></script>
    <!--Pretty Photo JavaScript-->
    <script src="{{asset('/')}}frontend/js/jquery.prettyPhoto.js"></script>
    <!--Image Filterable JavaScript-->
    <script src="{{asset('/')}}frontend/js/jquery-filterable.js"></script>
    <!--Number Count (Waypoints) JavaScript-->
    <script src="{{asset('/')}}frontend/js/waypoints-min.js"></script>
    <!--Custom JavaScript-->
    <script src="{{asset('/')}}frontend/js/custom.js"></script>

    <script>

        $(document).ready(function() {
            $('.slider').slick({
                slidesToShow: 1, // Show one slide at a time
                slidesToScroll: 1, // Scroll one slide at a time
                autoplay: true, // Enable auto sliding
                autoplaySpeed: 5000, // Delay before the next slide (5000ms = 5 seconds)
                speed: 1000, // Transition speed between slides (1000ms = 1 second)
                dots: true, // Enable dots for navigation
                arrows: true // Show navigation arrows
            });



            console.log('chutiye');
            $('#mg-responsive-navigation').dlmenu();
        })
    </script>


@endsection
