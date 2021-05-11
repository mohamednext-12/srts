<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.shared.title-meta', ['title' => "Forgot Password"])

    @include('layouts.shared.head-css')
</head>

<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{route('index')}}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="22">
                                            </span>
                                </a>

                                <a href="{{route('index')}}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="22">
                                            </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">  {{ __('Send Password Reset Link') }} </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Back to <a href="{{route('second', ['auth', 'login'])}}" class="text-white ml-1"><b>Log in</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script> &copy; App By <a href="" class="text-white-50">Next</a>
</footer>

@include('layouts.shared.footer-script')

</body>
</html>
