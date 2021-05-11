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
                            <li class="breadcrumb-item active">{{__('Modifier une Catégorie')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Modifier une Catégorie')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Modification')}}</h4>
                        <p class="text-muted font-14 mb-3 text-center">
                            <code>
                            {{app()->getLocale()=='fr'?$subscriptionCategory->name_french:$subscriptionCategory->name_arab}}
                            </code>
                        </p>

                        <form class="needs-validation" novalidate method="POST" action="{{ route('subscriptionCategories.update',$subscriptionCategory->id) }}">
                           @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name_french">{{ __('Nom Francais') }}</label>
                                <input name="name_french" type="text" class="form-control" id="name_french" @error('name') is-invalid @enderror placeholder="{{ __('Nom Francais') }}" value="{{$subscriptionCategory->name_french}}" required>
                                @error('name_french')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name_arab">{{ __('Nom Arabe') }}</label>
                                <input name="name_arab" type="text" class="form-control" id="name_arab" @error('name_arab') is-invalid @enderror placeholder="{{ __('Nom Arabe') }}" value="{{$subscriptionCategory->name_arab}}" required>
                                @error('name_arab')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Description') }}</label>
                                <input name="description"  type="text" class="form-control" id="validationCustom02" @error('description') is-invalid @enderror placeholder="{{ __('Description') }}" value="{{$subscriptionCategory->description}}" required>
                                @error('description')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
{{--                            <div class="mt-3">--}}
{{--                                <label >{{ __('Type Catégorie') }}</label>--}}
{{--                                <div class="custom-control custom-radio ">--}}
{{--                                    <input type="radio" id="customRadio1" name="type" class="custom-control-input" @if($subscriptionCategory->type=="scolaire") checked @endif value="scolaire">--}}
{{--                                    <label class="custom-control-label" for="customRadio1">{{__('Scolaire')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio">--}}
{{--                                    <input type="radio" id="customRadio2" name="type" class="custom-control-input" @if($subscriptionCategory->type=="civile") checked @endif value="civile">--}}
{{--                                    <label class="custom-control-label" for="customRadio2">{{__('Civile')}}</label>--}}
{{--                                </div>--}}
{{--                                <div class="custom-control custom-radio">--}}
{{--                                    <input type="radio" id="customRadio3" name="type" class="custom-control-input" @if($subscriptionCategory->type=="sociale") checked @endif value="sociale">--}}
{{--                                    <label class="custom-control-label" for="customRadio3">{{__('Sociale')}}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group mb-3">
                                <label >{{ __('Liste des périodes') }}</label>
                                @foreach($periods as $period)
                                    <div class="custom-control custom-checkbox">
                                        <input name="period[]"
                                                    @if($subscriptionCategory->periods->find($period->id))
                                                    checked
                                                    @endif
                                               type="checkbox" class="custom-control-input" id="{{$period->id}}" value="{{$period->id}}">
                                        <label class="custom-control-label" for="{{$period->id}}">{{$period->name_french}}</label>
                                    </div>
                                @endforeach
                                @if($errors->has('period'))
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $errors->first('period') }}</strong>
                                        </span>
                                @endif
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
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
{{--    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>--}}
@endsection
