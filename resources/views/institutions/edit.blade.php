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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Validation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Etablissement')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Modification')}}</h4>
                        <p class="sub-header"></p>
                        <form class="needs-validation" novalidate method="POST" action="{{ route('institutions.update',$institution) }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <label for="name_arab">{{ __("Nom d'etablissement en arabe") }}</label>
                                <input name="name_arab" type="text" class="form-control" id="name_arab" @error('name_arab') is-invalid @enderror placeholder="{{ __("Nom d'etablissement en arabe") }}" value="{{$institution->name_arab}}" required>
                                @error('name_arab')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name_french">{{ __("Nom d'etablissement en francais") }}</label>
                                <input name="name_french" type="text" class="form-control" id="name_french" @error('name_french') is-invalid @enderror placeholder="{{ __("Nom d'etablissement en francais") }}" value="{{$institution->name_french}}" required>
                                @error('name_french')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold text-muted">{{ __('choisir le niveau') }}</p>
                                <select name="level" class="form-control"  data-placeholder="{{ __('choisir le niveau') }}">
                                    @foreach($municipalities as $municipality)
                                        <option {{$municipality->id==$institution->municipality_id ? 'selected' : ''}} value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}|{{$municipality->name_french}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold text-muted">{{ __('choisir le niveau') }}</p>
                                <select name="level" class="form-control"  data-placeholder="{{ __('choisir le niveau') }}">
                                    @foreach($levels as $level)
                                        <option {{$level->id==$institution->level_id ? 'selected' : ''}} value="{{$level->id}}">{{$level->name_arab}}|{{$level->name_french}}</option>>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('institutions.index')}}">{{ __('Retour') }}</a>
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
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
