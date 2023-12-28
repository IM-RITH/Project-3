@extends('front.layout.app')

@section('seo_title')
    {{ $privacy_page_item->title }}
@endsection
@section('seo_meta_description')
    {{ $privacy_page_item->meta_description }}
@endsection
@section('main_content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $privacy_page_item->heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>Privacy Policy

                        Effective date: [01.12.2023] <br> <br>

                        <strong>1. Introduction</strong><br>
                        Jobify respects the privacy of our users. This Privacy
                        Policy explains how we collect, use, disclose, and safeguard your information when you visit our
                        website jobify.com, including any other media form, media channel, mobile website, or mobile
                        application related or connected thereto. Please read this privacy policy carefully. If you do not
                        agree with the terms of this privacy policy, please do not access the site. <br> <hr>

                        <strong>2. Information We Collect</strong><br><br>
                        We may collect information about you in a variety of ways. The information we may collect on the
                        Site includes:

                        - Personal Data: Personally identifiable information, such as your name, shipping address, email
                        address, and telephone number, and demographic information, such as your age, gender, hometown, and
                        interests, that you voluntarily give to us when you register with the Site or when you choose to
                        participate in various activities related to the Site. <br>
                        - Derivative Data: Information our servers automatically collect when you access the Site, such as
                        your IP address, your browser type, your operating system, your access times, and the pages you have
                        viewed directly before and after accessing the Site. <br><hr>

                        <strong>3. Use of Your Information</strong> <br><br>
                        Having accurate information about you permits us to provide you with a smooth, efficient, and
                        customized experience. Specifically, we may use information collected about you via the Site to:

                        - Create and manage your account. <br>
                        - Offer new products, services, and/or recommendations to you. <br>
                        - Monitor and analyze usage and trends to improve your experience with the Site. <br>
                        <hr>
                        <strong>4. Disclosure of Your Information</strong><br><br>
                        We may share information we have collected about you in certain situations. Your information may be
                        disclosed as follows:

                        - By Law or to Protect Rights: If we believe the release of information about you is necessary to
                        respond to legal process, to investigate or remedy potential violations of our policies, or to
                        protect the rights, property, and safety of others, we may share your information as permitted or
                        required by any applicable law, rule, or regulation. <br><hr>

                        <strong>5. Security of Your Information</strong><br><br>
                        We use administrative, technical, and physical security measures to help protect your personal
                        information. While we have taken reasonable steps to secure the personal information you provide to
                        us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and
                        no method of data transmission can be guaranteed against any interception or other type of misuse. <br> <hr>

                        <strong>6. Options Regarding Your Information</strong><br><br>
                        You may at any time review or change the information in your account or terminate your account by: <br>

                        - Logging into your account settings and updating your account. <br>
                        - Contacting us using the contact information provided below. <br>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
