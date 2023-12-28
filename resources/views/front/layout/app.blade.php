<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="@yield('seo_meta_description')">
    <title>@yield('seo_title')</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}" />

    {{-- style --}}
    @include('front.layout.style')

    {{-- script --}}
    @include('front.layout.script')



    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 left-side">
                    <ul>
                        <li class="phone-text">076 3635602</li>
                        <li class="email-text">sovanrithsrey@gmail.com</li>
                    </ul>
                </div>
                <div class="col-md-6 right-side">
                    <ul class="right">
                        <li class="menu">
                            <a href="login.html"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="menu">
                            <a href="signup.html"><i class="fas fa-user"></i> Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('front.layout.nav')
    @yield('main_content')

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <h2 class="heading">For Candidates</h2>
                        <ul class="useful-links">
                            <li><a href="">Browser Jobs</a></li>
                            <li><a href="">Browse Candidates</a></li>
                            <li><a href="">Candidate Dashboard</a></li>
                            <li><a href="">Saved Jobs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <h2 class="heading">For Companies</h2>
                        <ul class="useful-links">
                            <li><a href="">Post Job</a></li>
                            <li><a href="">Browse Jobs</a></li>
                            <li><a href="">Company Dashboard</a></li>
                            <li><a href="">Applications</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <h2 class="heading">Contact</h2>
                        <div class="list-item">
                            <div class="left">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="right">
                                23 Ta Quang Buu
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="left">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="right">076 3635602</div>
                        </div>
                        <div class="list-item">
                            <div class="left">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="right">sovanrithsrey@gmail.com</div>
                        </div>
                        <ul class="social">
                            <li>
                                <a href="https://www.facebook.com/VANRITH.H/"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/Sovanrith13"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fab fa-pinterest-p"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/rith-rith-397b03247/"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/v_rithh/"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <h2 class="heading">Newsletter</h2>
                        <p>
                            To get the latest news from our website, please
                            subscribe us here:
                        </p>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" name="" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Subscribe Now" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright">
                        Copyright 2023, Srey Sovanrith. All Rights Reserved.
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="right">
                        <ul>
                            <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                            <li>
                                <a href="{{ route('privacy') }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-top">
        <i class="fas fa-angle-up"></i>
    </div>

    @include('front.layout.script_footer')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif

    @if (session()->get('error'))
        {
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('error') }}',
            });
        </script>
        }
    @endif
    @if (session()->get('success'))
        {
        <script>
            iziToast.success({
                title: '',
                position: 'topRight',
                message: '{{ session()->get('success') }}',
            });
        </script>
        }
    @endif
</body>

</html>
