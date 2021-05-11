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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Catégories')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Categories')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Catégories')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        <div class="row mb-2">
{{--                            <div class="col-sm-4">--}}
{{--                                <a href="{{route('subscriptionCategories.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>--}}
{{--                                    {{__('Ajouter une Catégorie')}}</a>--}}
{{--                            </div>--}}
                            <!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table  id="customers-datatable" class="table table-centered table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{__('Nom')}}</th>
                                        <th>{{__('Périodes')}}</th>
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
    <script>
        $(function () {

            var table = $('#customers-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subscriptionCategories.index') }}",
                columns: [
                    {data: 'name_french', name: 'name_french'},
                    // {data: 'description', name: 'description'},
                    {data: 'periods', name: 'periods'},
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
    <script>
        // Delete action
        $(document).on('click', '.delete', function(){
            id = $(this).attr('id');
            $('#'+id).parent().parent().css('border','2px solid #ff6666');
        });
        $('.modal').on('hidden.bs.modal',function () {
            $('.delete').parent().parent().css('border','none');
        })
        $('#delete').click(function(){
            $('#'+id).parent().parent().css('background-color','#ff6666');
            $.ajaxSetup({
                data: {  _token: '{{csrf_token()}}' },
                type:'DELETE',
                url:"/subscriptionCategories/"+id,
            });
            $.ajax({
                success:function(data)
                {
                    setTimeout(function(){
                        $('#customers-datatable').DataTable().ajax.reload();
                    }, 1000);
                }
            });
        });



    </script>
    <!-- Page js-->
{{--    <script src="{{asset('assets/js/pages/customers.init.js')}}"></script>--}}
@endsection

