@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Catégories')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Ajouter une Catégorie')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Catégorie')}}</h4>
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

                        <form class="needs-validation" novalidate method="POST" action="{{ route('subscriptionCategories.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Nom') }}</label>
                                <input name="name" type="text" class="form-control" id="validationCustom01" @error('name') is-invalid @enderror placeholder="{{ __('Nom') }}" value="{{old('name')}}" required>
                                @error('name')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Description') }}</label>
                                <input name="description"  type="text" class="form-control" id="validationCustom02" @error('description') is-invalid @enderror placeholder="{{ __('Description') }}" value="{{old('description')}}" required>
                                @error('description')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
{{--                            <div class="mt-3">--}}
{{--                                <label >{{ __('Type Catégorie') }}</label>--}}
{{--                                <div class="custom-control custom-radio">--}}
{{--                                    <input type="radio" id="customRadio1" name="type" class="custom-control-input" value="scolaire">--}}
{{--                                    <label class="custom-control-label" for="customRadio1">{{__('Scolaire')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio">--}}
{{--                                    <input type="radio" id="customRadio2" name="type" class="custom-control-input" value="civile">--}}
{{--                                    <label class="custom-control-label" for="customRadio2">{{__('Civile')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio">--}}
{{--                                    <input type="radio" id="customRadio3" name="type" class="custom-control-input" value="sociale">--}}
{{--                                    <label class="custom-control-label" for="customRadio3">{{__('Sociale')}}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group mb-3">
                                <label >{{ __('Liste des périodes') }}</label>
                                    @foreach($periods as $period)
                                    <div class="custom-control custom-checkbox">
                                        <input name="period[]" type="checkbox" class="custom-control-input" id="{{$period->id}}" value="{{$period->id}}">
                                         <label class="custom-control-label" for="{{$period->id}}">{{$period->name}}</label>
                                    </div>
                                    @endforeach
                                @if($errors->has('period'))
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $errors->first('period') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('subscriptionCategories.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
{{--    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>--}}
@endsection
