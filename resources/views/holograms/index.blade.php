@extends('layouts.horizontal', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-3 ">
                <a href="{{route('holograms.index')}}">
                <div class="widget-rounded-circle card-box" style="border: #0a62de 2px solid;cursor: pointer">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-shopping-bag font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{$stock}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Stock Disponible')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('shipment.index')}}">
                <div class="widget-rounded-circle card-box" style="cursor: pointer">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{$route}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Stock En Route')}} </p>
                                <p class="text-muted mb-1 text-truncate">{{__('Stock En Retard')}}: {{$retard}} </p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('declarations.index')}}">
                <div class="widget-rounded-circle card-box" style="cursor: pointer">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{$return}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Liste des Retours')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('demands.index')}}">
                <div class="widget-rounded-circle card-box" style="cursor: pointer">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{$demand}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Liste des Demandes')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Stock')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Stocks')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Stocks')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            @hasrole('admin')
                            <div class="col-sm-4">
                                <a href="{{route('chains.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>{{__('Ajouter un Stock')}}</a>
                                <a href="{{route('chains.send')}}" class="btn btn-info mb-2"><i class="mdi mdi-share-circle mr-2"></i>{{__('Envoyer un Stock')}}</a>
                            </div>
                            @endhasrole
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="customers-datatable">
                                <thead>
                                <tr>
                                    <th>{{__('Quantité')}}</th>
                                    @hasrole('admin')
                                    <th>{{__('Envoyée')}}</th>
                                    <th>{{__('Bon de Commande')}}</th>

                                    <th>{{__("Date d'Ajout")}}</th>
                                    <th style="width: 75px;">{{__("Action")}}</th>
                                    @endhasrole
                                    @hasrole('supervisor')
                                    <th>{{__('Utilisée')}}</th>
                                    <th>{{__('Stock Cartes Restant')}}</th>
                                    <th>{{__("Date d'arrivé")}}</th>
                                    @endhasrole
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
        <!-- Danger Alert Modal -->
        <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">Suppression !</h4>
                            <p class="mt-3 text-white">Cette Action est irreversible</p>
                            <button id="delete" type="button" class="btn btn-light my-2" data-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-datatables-checkboxes/jquery-datatables-checkboxes.min.js')}}"></script>
        @hasrole('admin')
        <script>
        $(function () {
            var table = $('#customers-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('holograms.index') }}",
                columns: [
                    // {data: 'code', name: 'code'},
                    {data: 'qty', name: 'qty'},
                    {data: 'used', name: 'used'},
                    {data: 'receipt', name: 'receipt'},


                    // {data: 'used', name: 'used'},

                    // {data: 'returned', name: 'returned'},
                    // {data: 'agency', name: 'agency'},
                    {data: 'created_at', name: 'created_at'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

        });
    </script>
        @endhasrole
        @hasrole('supervisor')
        <script>
            $(function () {
                var table = $('#customers-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('chains.index') }}",
                    columns: [
                        // {data: 'code', name: 'code'},
                        {data: 'count', name: 'count'},
                        // {data: 'pack', name: 'pack'},

                        {data: 'used', name: 'used'},
                        {data: 'reste', name: 'reste'},

                        // {data: 'returned', name: 'returned'},
                        // {data: 'agency', name: 'agency'},
                        // {data: 'created_at', name: 'created_at'},
                        {data: 'date_arrive', name: 'date_arrive'},

                    ]
                });

            });
        </script>
        @endhasrole
{{--    <script>--}}
{{--        // Delete action--}}
{{--        $(document).on('click', '.delete', function(){--}}
{{--            id = $(this).attr('id');--}}
{{--            $('#'+id).parent().parent().css('border','2px solid #ff6666');--}}
{{--        });--}}
{{--       $('.modal').on('hidden.bs.modal',function () {--}}
{{--           $('.delete').parent().parent().css('border','none');--}}
{{--       })--}}
{{--        $('#delete').click(function(){--}}
{{--            $('#'+id).parent().parent().css('background-color','#ff6666');--}}
{{--            $.ajaxSetup({--}}
{{--                data: {  _token: '{{csrf_token()}}' },--}}
{{--                type:'DELETE',--}}
{{--                url:"/institutions/"+id,--}}
{{--            });--}}
{{--            $.ajax({--}}
{{--                success:function(data)--}}
{{--                {--}}
{{--                    setTimeout(function(){--}}
{{--                        $('#customers-datatable').DataTable().ajax.reload();--}}
{{--                    }, 1000);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}



{{--    </script>--}}
    <!-- Page js-->
@endsection

