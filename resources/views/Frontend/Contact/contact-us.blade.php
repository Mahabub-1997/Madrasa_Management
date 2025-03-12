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
    <div class="iq_wrapper">
        <!-- Header Section -->
        <header class="iq_header_1">
            <!-- Header content here -->
        </header>

        <!-- Banner Section -->
        <div class="iner_banner ent_detail">
            <div class="container">
                <h5>Contact</h5>
                <div class="banner_iner_capstion">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="contact-info">
            <div class="container">
                <h2>Contact Information</h2>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Our Address</h4>
                        <p>Madrasa Education System, House: 50 (4th floor), Road: 17, Sector: 11, Uttara, Dhaka-1230</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Phone Number</h4>
                        <p>+088 01768198718</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Email</h4>
                        <p>Mahabub_madrasa@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form Section -->
        <div class="contact-form">
            <div class="container">
                <h2>Contact Us</h2>
                <form action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" placeholder="Your Message" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
    <style>
        /* Contact Information Section Styles */
        .contact-info {
            background-color: #f4f4f4;
            padding: 40px 0;
            margin-top: 30px;
        }

        .contact-info h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .contact-info .col-md-4 {
            margin-bottom: 20px;
        }

        .contact-info h4 {
            font-size: 24px;
            color: #333;
        }

        .contact-info p {
            color: #777;
        }

        /* Contact Form Styles */
        .contact-form {
            padding: 40px 0;
            background-color: #fff;
        }

        .contact-form h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .contact-form button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #218838;
        }
    </style>


@endsection


