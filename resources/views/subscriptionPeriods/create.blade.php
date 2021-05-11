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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Periodes')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer Une Periode')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Periode')}}</h4>
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
                        <form class="needs-validation" novalidate method="POST" action="{{ route('subscriptionPeriods.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Nom arabe') }}</label>
                                <input name="name_arab" type="text" class="form-control" id="validationCustom01" @error('name_arab') is-invalid @enderror placeholder="{{ __('Nom arabe') }}" value="{{old('name_arab')}}" required>
                                @error('name_arab')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Nom francais') }}</label>
                                <input name="name_french" type="text" class="form-control" id="validationCustom01" @error('name_french') is-invalid @enderror placeholder="{{ __('Nom francais') }}" value="{{old('name_french')}}" required>
                                @error('name_french')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Description') }}</label>
                                <input name="description"  type="text" class="form-control" id="validationCustom02" @error('description') is-invalid @enderror placeholder="{{ __('Description') }}" value="{{old('description')}}" >
                                @error('description')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-info mb-3" id="test">{{__('ajouter une phase')}}</button>
                            <input hidden id="index" name="index" value="">
                            <div id="phases" class="mb-3" >

                            </div>

                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('agencies.index')}}">{{ __('Retour') }}</a>
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
            var index=0;
            $("#test").click(function(){
                index++;
                $('#index').val(index);
                $("#phases").append('<div id="'+index+'">'+
                '<label>{{__('Phase')}}'+index+'</label>'+
                '<div class="input-group mb-3">'+
                   ' <div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">{{__('nom arabe')}}</span>'+
                    '</div>'+
                    '<input  name="phase_arab['+index+']" autocomplete="off">'+
                    '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">{{__('nom francais')}}</span>'+
                    '</div>'+
                    '<input  name="phase_french['+index+']" autocomplete="off">'+
                    '</div>'+
                    '<div class="input-group mb-3">'+
                    '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">{{__('debut')}}</span>'+
                    '</div>'+
                   ' <input  class="date" name="date_deb['+index+']" autocomplete="off">'+
                    '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="basic-addon1">{{__('fin')}}</span>'+
                    '</div>'+
                    '<input class="date" name="date_fin['+index+']" autocomplete="off">'+
                   ' </div>'+
                   ' </div>');
                $('.date').datepicker({
                    format: 'dd-mm',
                    autoclose: true,
                    language: 'fr',
                    startView: 1,
                    maxViewMode: "months",
                    orientation: "top left",
                })
            });

    </script>


@endsection
