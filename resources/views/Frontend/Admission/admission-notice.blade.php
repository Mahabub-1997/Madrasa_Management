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
        @media (max-width: 480px) {
            /* Make the table scrollable on small screens */
            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0;
            }

            .table {
                width: 100%;
                table-layout: fixed; /* Prevent table from overflowing */
            }

            /* Adjust margins and make the content fit better on smaller screens */
            .iq_search_courses {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .iq_search_courses h4 {
                font-size: 16px;
                text-align: center;
            }

            .col-md-1, .col-md-7 {
                width: 100%;
                display: block;
                text-align: left;
            }

            /* Style the breadcrumb for small screens */
            .banner_iner_capstion ul {
                font-size: 12px;
                padding-left: 0;
            }

            .banner_iner_capstion li {
                display: inline-block;
                margin-right: 5px;
            }

            .banner_iner_capstion a {
                color: #fff;
                font-size: 12px;
            }

            /* Adjust other text and headings */
            .admissionNotice {
                font-size: 18px;
                text-align: center;
                margin-bottom: 15px;
            }

            .admissionNoticeHome {
                font-size: 14px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="iq_wrapper">
        <!--Banner Wrap Start-->
        <div class="iner_banner">
            <div class="container">
                <h5 class="admissionNotice"></h5>
                <div class="banner_iner_capstion">
                    <ul>
                        <li><a class="admissionNoticeHome" href="#">Home</a></li>
                        <li><a class="admissionNotice" href="#">Admission Notice</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="iq_search_courses" style="margin-left: 25%">

                <table class="table table-responsive">
                    <h4>Madrasa Admission Information 2025</h4>
                    <thead>
                    <tr>
                        <th class="col-md-1">Title</th>
                        <th class="col-md-7">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-1" data-label="Title">Age Limit:</td>
                        <td class="col-md-7" data-label="Description">Minimum 4 years for Nazira and 7 years for Hifz program.</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Required Documents:</td>
                        <td class="col-md-7" data-label="Description">Birth certificate. Recent passport-sized photographs (4 copies). Previous academic certificates (if applicable). Copy of guardian's national ID card.</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Offered Programs:</td>
                        <td class="col-md-7" data-label="Description">Nazira Quran (Basic Quran Recitation). Hifz-ul-Quran (Quran memorization). Tafsir & Hadith Studies (Advanced Islamic Studies). Arabic Grammar & Language.</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Admission Deadline:</td>
                        <td class="col-md-7" data-label="Description">The deadline for online admission for the 2024-25 academic session for the 11th grade has been extended. According to the new schedule, students can complete online admission in colleges and madrasas until August 5.</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Application Start Date:</td>
                        <td class="col-md-7" data-label="Description">[10/01/2025].</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">End Date:</td>
                        <td class="col-md-7" data-label="Description">[31/01/2025].</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Admission Test Date:</td>
                        <td class="col-md-7" data-label="Description">[02/02/2025].</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Result Declaration:</td>
                        <td class="col-md-7" data-label="Description">[10/02/2025].</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Provided Facilities:</td>
                        <td class="col-md-7" data-label="Description">Well-furnished classrooms in an Islamic environment. Boarding and accommodation facilities for students (if applicable). Qualified and experienced teachers. Focus on both Islamic and modern education.</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" data-label="Title">Admission Procedure:</td>
                        <td class="col-md-7" data-label="Description">Collect the application form from the madrasa office or website. Submit the completed form with required documents. Attend the admission test/interview. Pay the admission fee after confirmation.</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!--Banner Wrap End-->
@endsection

@section('scripts')
    <script src="{{asset('/')}}frontend/js/admission.notice.localization.js"></script>
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
        });
    </script>
@endsection


