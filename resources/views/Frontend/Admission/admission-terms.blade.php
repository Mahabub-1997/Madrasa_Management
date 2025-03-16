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
    <div class="col-md-8" style="margin-left: 25% ; margin-top: 15px">

        <table class="table">

            <tr>
                <th class="col-md-1">Title</th>
                <th class="col-md-7">Description</th>
            </tr>
            <tr>
                <td class="col-md-1">Document Collection</td>
                <td class="col-md-7">Birth certificate (for age verification).
                    Copy of the father/mother/guardian's national ID.
                    Passport-sized photo (4-6 copies).
                    Previous academic certificates (if registering for higher level).
                    Medical certificate (if required by the madrasa).</td>
            </tr>
            <tr>
                <td class="col-md-1">Fee Payment:</td>
                <td class="col-md-7">

                    Pay the prescribed admission fee (if applicable) at the madrasa office or through online banking (if available).
                    Collect the payment receipt as proof.</td>
            </tr>
            <tr>
                <td class="col-md-1">Admission Test/Interview:</td>
                <td class="col-md-7">Attend the admission test, which may include:
                    Basic Quran recitation skills.
                    General knowledge or academic questions (for higher levels).
                    Oral interview to assess discipline and preparation.</td>
            </tr>

        </table>
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

