<!DOCTYPE html>
<html lang="app()->getLocale()">

    <head>
        @include('layouts.shared.title-meta', ['title' => "Log In"])

        @include('layouts.shared.head-css')
    </head>

    <body class="authentication-bg authentication-bg-pattern" style="background-image: {{asset('assets/images/localisation.jpg')}} !important;">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('storage/login.png')}}" alt="" height="80">
                                            </span>
                                        </a>

                                        <a href="" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="80">
                                            </span>
                                        </a>
                                    </div>
{{--                                    <p class="text-muted mb-4 mt-3">Entrer Votre Email address and password to access admin panel.</p>--}}
                                </div>

                                <form action="{{route('login')}}" method="POST" novalidate>
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">{{__('Email')}}</label>
                                        <input class="form-control  @if($errors->has('email')) is-invalid @endif" name="email" type="email"
                                            id="emailaddress" required=""
                                            value="{{ old('email')}}"
                                            placeholder="Entrer Votre Email" />

                                            @if($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                    </div>

                                    <div class="form-group mb-3">
    {{--                                        <a href="{{route('login')}}" class="text-muted float-right"><small>Forgot your--}}
    {{--                                            password?</small></a>--}}
                                        <label for="password">{{__('Mot de Passe')}}</label>
                                        <div class="input-group input-group-merge @if($errors->has('password')) is-invalid @endif">
                                            <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password" required=""
                                                id="password" placeholder="Entrer Votre Mot de Passe" />
                                                <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">{{__('se souvenir de moi')}}</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> {{__('login')}} </button>
                                    </div>

                                </form>

{{--                                <div class="text-center">--}}
{{--                                    <h5 class="mt-3 text-muted">Sign in with</h5>--}}
{{--                                    <ul class="social-list list-inline mt-3 mb-0">--}}
{{--                                        <li class="list-inline-item">--}}
{{--                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="list-inline-item">--}}
{{--                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="list-inline-item">--}}
{{--                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="list-inline-item">--}}
{{--                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

                            <div class="text-center">
                                <img src="{{asset('assets/images/abono.png')}}" alt="" height="80">
                            </div>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

{{--                        <div class="row mt-3">--}}
{{--                            <div class="col-12 text-center">--}}
{{--                                <p> <a href="{{route('second', ['auth', 'recoverpw-2'])}}" class="text-white-50 ml-1">Forgot your password?</a></p>--}}
{{--                                <p class="text-white-50">Don't have an account? <a href="{{route('register')}}" class="text-white ml-1"><b>Sign Up</b></a></p>--}}
{{--                            </div> <!-- end col -->--}}
{{--                        </div>--}}
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> &copy; Développé par <a href="" class="text-white-50">Next</a>
        </footer>

        @include('layouts.shared.footer-script')

    </body>
</html>
