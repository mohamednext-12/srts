@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item active">{{__('Modifier Un Utilisateur')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Modifier un Utilisateur')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Modification')}}</h4>
                        <p class="sub-header"></p>

                        <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                                <a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                    <i class="mdi mdi-account-circle mr-1"></i>
                                    <span class="d-none d-sm-inline">{{__('Informations Générales')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline">{{__('Mot de Passe')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#basictab3" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline">{{__('Photo')}}</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 mb-0 pt-0">
                            <div class="tab-pane active" id="basictab1">
                                <form id="form" class="needs-validation" novalidate method="POST" action="{{ route('users.update',$user->id) }}">
                                    @method('put')
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">{{ __('Nom') }}</label>
                                        <input name="name" type="text" class="form-control" id="name" @error('name') is-invalid @enderror placeholder="{{ __('Nom') }}" value="{{$user->name}}" required>
                                        @error('name')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input name="email"  type="email" class="form-control" id="email" @error('email') is-invalid @enderror placeholder="{{ __('Email') }}" value="{{$user->email}}" required>
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
                                                <option {{$user->agency->id==$agency->id ? 'selected' : ''}} value="{{$agency->id}}">{{$agency->name}}|{{$agency->code}}|{{$agency->address}}</option>
                                            @endforeach
                                        </select>
                                        @error('agency')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="role">{{ __('Role') }}</label>
                                        <select name="role" class="selectpicker mb-0 show-tick"   data-style="btn-light">
                                            @foreach($roles as $role)
                                                <option {{$userRole==$role->name ? 'selected' : ''}} value="{{$role->name}}">{{$role->id=="2" ? __('superviseur') : ($role->id=="3" ? __('utilisateur') :__('administrateur'))}}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    @endrole
                                    <div class="row ">
                                        <div class="col-6 float-right">
                                            <a class="btn btn-success float-right mr-2" href="{{route('users.index')}}">{{ __('Retour') }}</a>
                                        </div>
                                        <div class="col-6 ">
                                            <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="basictab2">
                                <form id="form-2" class="needs-validation" novalidate method="POST" action="{{ route('users.password.update',$user->id) }}">
                                    @method('put')
                                    @csrf
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
                            </div>
                            <div class="tab-pane" id="basictab3">
                                <form id="form-2" class="needs-validation" novalidate method="POST" action="{{ route('users.picture.update',$user->id) }}" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input id="upload-scolaire" class="dropify" name="picture" type="file" data-plugins="dropify" />
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
                            </div>

                        </div> <!-- tab-content -->
                    </div>
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

    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script>
            // Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
            var imagenUrl = "{{asset('storage/users/'.$user->picture)}}";
            var drEvent = $('[data-plugins="dropify"]').dropify({
                defaultFile: imagenUrl ,
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();

    </script>
    <!-- Page js-->
@endsection
