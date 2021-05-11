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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Validation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Form Validation</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Bootstrap Validation - Normal</h4>
                        <p class="sub-header">Provide valuable, actionable feedback to your users with HTML5 form validation–available in all our supported browsers.</p>

                        <form id="form" class="needs-validation"  method="POST" action="{{ route('demands.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-4">
                                    <label for="start">{{ __('Debut Numéro Carte') }}</label>
                                    <input name="start" type="text" class="form-control " id="start" @error('start') is-invalid @enderror placeholder="{{ __('Debut Numéro Carte') }}" value="{{old('start')}}" >
                                    @error('start')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="end">{{ __('Fin Numéro Carte') }}</label>
                                    <input name="end" type="text" class="form-control " id="end" @error('end') is-invalid @enderror placeholder="{{ __('Fin Numéro Carte') }}" value="{{old('end')}}" >
                                    @error('end')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="name_arab">{{ __('Quantité') }}</label>
                                    <input name="qty" type="text" class="form-control" id="qty" @error('qty') is-invalid @enderror placeholder="{{ __('Quantité') }}" value="{{old('qty')}}" required>
                                    @error('qty')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <select id="agency" name="agency" class="form-control mt-2 "
                                        data-toggle="select2" data-placeholder="{{ __("choisir l'Agence") }}">
                                    @foreach($agencies as $agency)
                                        <option data-value="{{$agency->num}}"
                                                value="{{$agency->id}}">{{ __('Agence') }}
                                            : {{$agency->code}}|{{$agency->address}} </option>>
                                    @endforeach
                                </select>

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
