@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Stock')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer un Stock Hologramme')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer un Stock Hologramme')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <p class="sub-header"></p>
                        <form id="form" class="needs-validation"  method="POST" action="{{ route('holograms.store') }}">
                            @csrf
                            <div id="stock">
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-3 mx-auto">
                                        <label for="receipt">{{ __('Bon de Commande') }}</label>
                                        <input name="receipt" type="text" class="form-control" id="receipt" @error('v') is-invalid @enderror placeholder="{{ __('Numéro Bon de Commande') }}" value="{{old('receipt')}}" required>
                                        @error('receipt')
                                        <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                             <div class="form-row">
                                 @foreach($types as $type)

                                <div class="form-group mb-3 col-md-2">
                                    <input type="checkbox" name="type[{{$type->id}}]" value="{{$type->id}}" class="typecheck">
                                    <label for="end">{{ __('Type Hologramme') }}</label>
                                            <option value="{{$type->id}}">
                                           <b>{{$type->number}}</b>   - {{$type->price}}
                                            </option>
                                    @error('end')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="qtycontainer"></div>
                                </div>
                                 @endforeach
                            </div>
                            </div>

{{--                            <div class="form-group mb-3 ">--}}
{{--                                <select id="agency" name="agency" class="form-control mt-2 "--}}
{{--                                        data-toggle="select2" data-placeholder="{{ __("choisir l'Agence") }}">--}}
{{--                                    @foreach($agencies as $agency)--}}
{{--                                        <option data-value="{{$agency->num}}"--}}
{{--                                                value="{{$agency->id}}">{{ __('Agence') }}--}}
{{--                                            : {{$agency->code}}|{{$agency->address}} </option>>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}

{{--                            </div>--}}
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

    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <!-- Page js-->
    <script>
        $(document).ready(function () {
            $('body').on('click','.typecheck',function () {
                let myid = $(this).val();
                if($(this).prop('checked'))
                {
                    $(this).parent().find('.qtycontainer').html(`<div class="form-group">
                                                                    <label for="name_arab">{{ __('Quantité') }}</label>
                                                                    <input name="type[`+ myid +`][qty]" type="number" class="form-control"  required>
                                                                  </div>`);
                }
                else{
                    $(this).parent().find('.qtycontainer').empty();
                }
            })
        })
    </script>

@endsection
