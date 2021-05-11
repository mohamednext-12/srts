@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Utilisateurs')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer un Utilisateur')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer un Utilisateur')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <p class="sub-header"></p>

                        <form id="form" class="needs-validation" novalidate method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">{{ __('Nom') }}</label>
                                <input name="name" type="text" class="form-control" id="name" @error('name') is-invalid @enderror placeholder="{{ __('Nom') }}" value="{{old('name')}}" required>
                                @error('name')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Email') }}</label>
                                <input name="email"  type="email" class="form-control" id="validationCustom02" @error('email') is-invalid @enderror placeholder="{{ __('Email') }}" value="{{old('email')}}" required>
                                @error('email')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @role('admin')
                            <div class="form-group mb-3">
                                <label for="agency">{{ __('Agence') }}</label>
                                <select name="agency" class="selectpicker mb-0 show-tick"   data-style="btn-light">
                                   @foreach($agencies as $agency)
                                    <option value="{{$agency->id}}">{{$agency->name}}|{{$agency->code}}|{{$agency->address}}</option>
                                   @endforeach
                                </select>
                                @error('agency')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endrole
                            <div class="form-group mb-3">
                                <label for="role">{{ __('Role') }}</label>
                                <select name="role" class="selectpicker mb-0 show-tick"   data-style="btn-light">
                                   @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->id=="2" ? __('superviseur') : ($role->id=="3" ? __('utilisateur') :__('administrateur'))}}</option>
                                   @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">{{ __('Mot de Passe') }}</label>
                                <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password" required id="password" placeholder="{{ __('Entrer votre mot de passe') }}" />
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">{{ __('Confirmer votre Mot de Passe') }}</label>
                                <input class="form-control @if($errors->has('confirm_password')) is-invalid @endif"
                                       name="confirm_password" type="password" required id="confirm_password" placeholder="{{ __('Confirmer votre Mot de Passe') }}" />

                                @if($errors->has('confirm_password'))
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('users.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>

    <!-- Page js-->
@endsection
