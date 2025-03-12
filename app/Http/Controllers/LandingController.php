<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function dashboard(){

        return view('FrontEnd.Landing.landing');
    }
    public function admissionNotice(){
        return view('Frontend.Admission.admission-notice');
    }
    public function admissionProcess(){
        return view('Frontend.Admission.admission-process');
    }
    public function admissionTerms(){
        return view('Frontend.Admission.admission-terms');
    }
    public function ContactUs(){
        return view('Frontend.Contact.contact-us');
    }
    public function gallaryUs(){
        return view('Frontend.Gallary.gallary');
    }
}
