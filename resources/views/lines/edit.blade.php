@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}


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
                            <li class="breadcrumb-item active">Wizard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Modifier Une Ligne')}}</h4>
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

                        <form method="post" class="needs-validation" action="{{route('lines.update',$line->id)}}" novalidate>
                            @method('put')
                            @csrf
                            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Numéro') }}</label>
                                <input name="num" type="number" class="form-control"
                                       id="validationCustom01" @error('num') is-invalid
                                       @enderror placeholder="{{ __('numéro') }}"
                                       value="{{$line->num}}" required>
                                @error('num')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold text-muted">Station(s)</p>
                                <select id="stations" name="stations[]"
                                        class="form-control select2-multiple"
                                        data-toggle="select2" multiple="multiple"
                                        data-placeholder="{{ __('choisir les lignes') }}">
                                    @foreach($stations as $station)
                                        <option @if($line->stations->find($station->id)) selected="true" @endif data-value="{{$station->num}}"
                                                value="{{$station->id}}">{{ __('Station numéro') }}
                                            : {{$station->num}}</option>>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-12 ">
                                    <div class="form-group mb-3">
                                        <label for="distance">{{__('Distance')}}</label>
                                        <input name="distance" class="form-control" type="text" placeholder="{{__('Distance')}} {{__('Km')}}" value="{{$line->distance}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input name="scolaire" id="scolaire" type="checkbox" value="1" {{$line_scolaire ? 'checked' : ''}} >
                                            <label for="scolaire">
                                                {{__('Scolaire')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-group mb-3">
                                        {{--                                        <label for="stations">{{__('Prix')}}</label>--}}
                                        <input name="price-scolaire" class="form-control" type="text" placeholder="{{__('prix')}}" value="{{$line_scolaire ? $line_scolaire->pivot->price : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input name="civile" id="civile" type="checkbox" value="2" {{$line_civile ? 'checked' : ''}}>
                                            <label for="civile">
                                                {{__('civile')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        {{--                                        <label for="stations">{{__('Prix')}}</label>--}}
                                        <input name="price-civile" class="form-control" type="text" placeholder="{{__('prix')}}" value="{{$line_civile ? $line_civile->pivot->price : ''}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('lines.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-wizard.init.js')}}"></script>



    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $('.select2-multiple').select2();
        // $(".select2-multiple ").change(function () {
        //     $(this).find('option:selected').each(function () {
        //         console.log($(this).attr('data-value'));
        //         $(".sortable")
        //     });
        // });
    </script>

@endsection
