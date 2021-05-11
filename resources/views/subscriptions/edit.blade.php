@extends('layouts.vertical', ['title' => 'Validation | Parsley'])

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

                        <form class="needs-validation" novalidate method="POST" action="{{ route('subscriptionPeriods.update',$subscriptionPeriod->id) }}">
                           @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Nom') }}</label>
                                <input name="name" type="text" class="form-control" id="validationCustom01" @error('name') is-invalid @enderror placeholder="{{ __('Nom') }}" value="{{$subscriptionPeriod->name}}" required>
                                @error('name')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Description') }}</label>
                                <input name="description"  type="text" class="form-control" id="validationCustom02" @error('description') is-invalid @enderror placeholder="{{ __('Description') }}" value="{{$subscriptionPeriod->description}}" required>
                                @error('description')
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
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
