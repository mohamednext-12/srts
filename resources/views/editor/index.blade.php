@extends('layouts.vertical', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Customers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Customers</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

@endsection

@section('script')
    <!-- Plugins js-->
        <script src="https://cdn.scaleflex.it/plugins/filerobot-uploader/2.15.15/filerobot-uploader.min.js"></script>
        <script>
            let config = {
                container: 'example',
                filerobotUploadKey: '0cbe9ccc4f164bf8be26bd801d53b132'
            };
            let onUpload = (files) => {
                console.log('files: ', files);
                alert('Files uploaded successfully! check the console to see the uploaded files');
            };
            let uploader = FilerobotUploader.init(config, onUpload);

            uploader.open();
        </script>
@endsection

