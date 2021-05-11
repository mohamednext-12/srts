@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
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
                    <h4 class="page-title">{{__('Modifier Une Bus')}}</h4>
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
                        <form class="needs-validation" novalidate method="POST" action="{{ route('buses.update',$bus) }}">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Marque') }}</label>
                                <input name="brand" type="text" class="form-control" id="validationCustom02" @error('brand') is-invalid @enderror placeholder="{{ __('Marque') }}" value="{{$bus->brand}}" required>
                                @error('brand')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom03">{{ __('Nombre Places') }}</label>
                                <input name="number_place"  type="text" class="form-control" id="validationCustom03" @error('number_place') is-invalid @enderror placeholder="{{ __('Nombre Places') }}" value="{{$bus->number_place}}" required>
                                @error('number_place')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom04">{{ __('Date Circulation') }}</label>
                                <input name="date_circulation"  type="text" class="form-control datepicker" id="validationCustom04" @error('date_circulation') is-invalid @enderror placeholder="{{$bus->date_circulation}}" value="{{$bus->date_circulation}}" required>
                                @error('date_circulation')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom05">{{ __('Etat') }}</label>
                                <select name="condition" class="form-control" id="validationCustom05" @error('condition') is-invalid @enderror placeholder="{{ __('Etat') }}" value="{{$bus->condition}}" required>
                                    <option {{$bus->condition=='nouvelle' ? 'selected' : ''}} value="nouvelle">nouvelle</option>
                                    <option {{$bus->condition=='moyenne' ? 'selected' : ''}} value="moyenne">moyenne</option>
                                    <option {{$bus->condition=='vieille' ? 'selected' : ''}} value="vieille">vieille</option>
                                </select>
                                @error('condition')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom06">{{ __('Commentaire') }}</label>
                                <textarea name="comment"   class="form-control" id="validationCustom06" @error('comment') is-invalid @enderror placeholder="{{ __('Commentaire') }}" value="{{$bus->comment}}" required>{{$bus->comment}}</textarea>
                                @error('comment')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/i18n/datepicker.fr-FR.min.js" ></script>--}}
    <script>
        (function($){
            $.fn.datepicker.dates['fr'] = {
                days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
                daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
                daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
                months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
                today: "Aujourd'hui",
                monthsTitle: "Mois",
                clear: "Effacer",
                weekStart: 1,
                format: "dd/mm/yyyy"
            };
        }(jQuery));

        $('.datepicker').datepicker({
            language: 'fr',
            autoclose: true,
            todayHighlight: true
        })
    </script>

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


@endsection
