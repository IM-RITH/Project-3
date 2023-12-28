@extends('front.layout.app')

@section('seo_title')
    {{ $term_page_item->title }}
@endsection
@section('seo_meta_description')
    {{ $term_page_item->meta_description }}
@endsection
@section('main_content')
    <div class="page-top" style="background-image: url('uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $term_page_item->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{-- <h5>{!! $term_page_item-> content !!}</h5> --}}
                    <h5>
                        Terms of Use

                        Last updated: [01.12.2023] <br>
                        <hr>

                        <strong>1. Introduction</strong> <br>
                        Welcome to Jobify. By accessing our website (jobify.com), you agree to be bound by these Terms of
                        Use and to use our site in accordance with these Terms, our Privacy Policy, and any additional terms
                        and conditions that may apply to specific sections of the site or to products and services available
                        through the site or from Jobify. Accessing the site, in any manner, whether automated or otherwise,
                        constitutes use of the site and your agreement to be bound by these Terms of Use. <br>
                        <hr>
 
                        <strong>2. Use of the Site </strong><br>
                        You may use the site only for lawful purposes and in accordance with these Terms. You are granted a
                        non-exclusive, non-transferable, revocable license to access and use jobify.com strictly in
                        accordance with these terms of use. <br><hr>

                        <strong>3. Registration and Account Integrity</strong> <br>
                        As part of the registration process, you will create a personal profile by providing your name,
                        email address, and creating a password. You agree to maintain the confidentiality of your account
                        login information and are fully responsible for all activities that occur under your account.<br><hr>

                        <strong>4. User Obligations</strong> <br>
                        You agree to use Jobify’s services in a manner that is ethical and in compliance with the community
                        standards. You shall not upload, distribute or print anything that may be harmful to minors.<br><hr>

                        <strong>5. Intellectual Property Rights</strong> <br>
                        The content on Jobify, including text, graphics, images, and information obtained from Jobify’s
                        licensors, is protected by copyright, trademark, and other intellectual property laws.<br><hr>

                        <strong>6. Disclaimer of Warranties</strong> <br>
                        The site and all content, products, and services included on or otherwise made available to you
                        through the site are provided by Jobify on an "as is" and "as available" basis, unless otherwise
                        specified in writing. <br><hr>

                        <strong>7. Limitation of Liability</strong> <br>
                        Jobify will not be liable for any damages of any kind arising from the use of this site or from any
                        information, content, materials, products (including software) or services included on or otherwise
                        made available to you through the site.<br><hr>

                        <strong>8. Privacy Policy</strong> <br>
                        Please review our Privacy Policy, which also governs your visit to Jobify, to understand our
                        practices.<br><hr>

                        <strong>9. Modification of Terms</strong> <br>
                        Jobify reserves the right to change these terms and conditions from time to time at our sole
                        discretion.<br><hr>

                        <strong>10. Governing Law and Jurisdiction</strong> <br>
                        These terms and conditions are governed by and construed in accordance with the laws of [Your
                        Country/State], without giving effect to any principles of conflicts of law.<br><hr>

                        <strong>11. Contact Information </strong><br>
                        For any legal inquiries or questions about these Terms, please contact us at [Your Contact
                        Information].<br><hr>

                        This document is a starting point and should not be used as is for your legal documentation. Again,
                        I strongly recommend that you seek professional legal advice to ensure that your "Terms of Use"
                        comply with all applicable laws and regulations and are tailored to the specifics of your business.<br><hr>

                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
