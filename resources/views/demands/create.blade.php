@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Demandes')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer Une Demande')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Demande')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <p class="sub-header"></p>
                        <form id="form" class="needs-validation"  method="POST" action="{{ route('demands.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name_arab">{{ __('Quantité') }}</label>
                                    <input name="qty" type="text" class="form-control" id="qty" @error('qty') is-invalid @enderror placeholder="{{ __('Quantité') }}" value="{{old('qty')}}" required>
                                    @error('qty')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name_arab">{{ __('Date') }}</label>
                                    <input name="date" type="date" class="form-control" id="date" @error('date') is-invalid @enderror placeholder="{{ __('Date') }}" value="{{old('date')}}" required>
                                    @error('date')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('demands.index')}}">{{ __('Retour') }}</a>
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
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script >
        $.fn.datepicker.dates['fr'] = {
            days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            daysShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
            daysMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
            months: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            monthsShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                'Jul','Aou','Sep','Oct','Nov','Dec'],
            today: "Today",
            clear: "Clear",
            format: "mm/dd/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
        $.fn.datepicker.dates.fr.titleFormat="MM";

    </script>


    <script>
        $('.date').datepicker({
            format: 'dd-mm-yy',
            autoclose: true,
            language: 'fr',
            startView: 1,
            maxViewMode: "months",
            orientation: "top left",
        })
    </script>
@endsection
