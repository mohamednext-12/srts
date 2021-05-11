@extends('layouts.horizontal', ['title' => 'File Uploads | Dropzone | Dropify'])

@section('css')
    <!-- Plugins css -->
    @if(app()->getLocale()=='fr')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    @else
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput-rtl.min.css"/>
    @endif
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
                            <li class="breadcrumb-item active">{{__('Paramètres')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Paramètres')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- file preview template -->
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Paramètres')}}</h4>
                        <p class="sub-header"></p>
                        <form class="needs-validation" novalidate method="POST" action="{{ route('settings.update') }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <label for="age_scolaire">{{ __('Age Scolaire') }}</label>
                                <input name="age_scolaire" type="text" class="form-control" id="age_scolaire" @error('age_scolaire') is-invalid @enderror placeholder="{{ __('Age') }}" value="{{$settings->age_scolaire}}" required>
                                @error('age_scolaire')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="age_civile">{{ __('Age Civile') }}</label>
                                <input name="age_civile" type="text" class="form-control" id="age_civile" @error('age_civile') is-invalid @enderror placeholder="{{ __('Age') }}" value="{{$settings->age_civile}}" required>
                                @error('age_civile')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row ">
{{--                                <div class="col-6 float-right">--}}
{{--                                    <a class="btn btn-success float-right mr-2" href="{{route('home')}}">{{ __('Retour') }}</a>--}}
{{--                                </div>--}}
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Image Login')}}</h4>
                        <p class="sub-header">
                        </p>

                        <input id="input-id"  name="file" type="file" class="file" data-preview-file-type="text">

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Image Barre de Haut')}}</h4>
                        <p class="sub-header">

                        </p>

                        <input id="topbar"  name="file" type="file" class="file" data-preview-file-type="text">

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Image Icône')}}</h4>
                        <p class="sub-header">

                        </p>

                        <input id="favicon"  name="file" type="file" class="file" data-preview-file-type="text">

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/sortable.min.js" type="text/javascript"></script>
    @if(app()->getLocale()=='fr')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput-rtl.min.js"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/themes/fas/theme.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/locales/fr.js"></script>
    <script>
        $("#input-id").fileinput({
            uploadUrl: "{{route('file-upload')}}",
            autoReplace: true,
            overwriteInitial: true,
            showUploadedThumbs: false,
            maxFileCount: 1,
            initialPreview: [
                "<img class='kv-preview-data file-preview-image' src='{{asset('storage/login.png')}}'>"
            ],
            initialCaption: 'login.jpg',
            initialPreviewShowDelete: false,
            showRemove: false,
            showClose: false,
            layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
            allowedFileExtensions: ["jpg", "png", "gif"],
            theme: 'fas',
            uploadExtraData: function() {
                return {
                    _token: "{{ csrf_token() }}",
                    _method: 'POST',
                };
            },
        });
        $("#topbar").fileinput({
            uploadUrl: "{{route('topbar-upload')}}",
            autoReplace: true,
            overwriteInitial: true,
            showUploadedThumbs: false,
            maxFileCount: 1,
            initialPreview: [
                "<img class='kv-preview-data file-preview-image' src='{{asset('storage/topbar.png')}}'>"
            ],
            initialCaption: 'topbar.jpg',
            initialPreviewShowDelete: false,
            showRemove: false,
            showClose: false,
            layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
            allowedFileExtensions: ["jpg", "png", "gif"],
            theme: 'fas',
            uploadExtraData: function() {
                return {
                    _token: "{{ csrf_token() }}",
                    _method: 'POST',
                };
            },
        });
        $("#favicon").fileinput({
            uploadUrl: "{{route('favicon-upload')}}",
            autoReplace: true,
            overwriteInitial: true,
            showUploadedThumbs: false,
            maxFileCount: 1,
            initialPreview: [
                "<img class='kv-preview-data file-preview-image' src='{{asset('storage/favicon.png')}}'>"
            ],
            initialCaption: 'favicon.jpg',
            initialPreviewShowDelete: false,
            showRemove: false,
            showClose: false,
            layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
            allowedFileExtensions: ["jpg", "png", "gif"],
            theme: 'fas',
            uploadExtraData: function() {
                return {
                    _token: "{{ csrf_token() }}",
                    _method: 'POST',
                };
            },
        });
    </script>
@endsection
