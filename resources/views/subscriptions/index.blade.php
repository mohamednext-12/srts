@extends('layouts.horizontal', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Abonnements')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Abonnements')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Abonnements')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        @unlessrole('admin')
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{route('subscriptions.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>
                                    {{__('Ajouter un Abonnement')}}</a>
                            </div>
                            <!-- end col-->
                        </div>
                        @endunlessrole
                        <div class="table-responsive">
                            <table  id="customers-datatable" class="table table-centered table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{__('Code')}}</th>
                                        <th>{{__('Client')}}</th>
                                        <th>{{__('Catégorie')}}</th>
                                        <th>{{__('Mandat')}}</th>
                                        <th>{{__('Ligne')}}</th>
                                        <th>{{__('Prix')}}</th>
                                        <th>{{__('Date de création')}}</th>
                                        <th style="width: 75px;">{{__("Action")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-datatables-checkboxes/jquery-datatables-checkboxes.min.js')}}"></script>
    <script>
        $(function () {

            var table = $('#customers-datatable').DataTable({
                processing: true,
                // scrollY:        200,
                deferRender:    true,
                // scroller:       true,
                ajax: "{{ route('subscriptions.index') }}",
                columns: [
                    {data: 'code', name: 'code'},
                    {data: 'client', name: 'client'},
                    {data: 'category', name: 'category'},
                    {data: 'mandat', name: 'mandat'},
                    {data: 'line', name: 'line'},
                    {data: 'price', name: 'price'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        order:'desc',
                        searchable: true
                    },
                ],
                // order:[0,'desc'],
                "language": {
                    @if(app()->getLocale()=="fr")
                    "url": "{{asset('assets/libs/datatables/datatableFrench.json')}}"
                    @else
                    "url": "{{asset('assets/libs/datatables/datatableArabic.json')}}"
                    @endif
                }
            });

        });
    </script>
    <!-- Page js-->
{{--    <script src="{{asset('assets/js/pages/customers.init.js')}}"></script>--}}
@endsection

