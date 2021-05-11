@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">{{__('Créer un Stocks')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer un Stocks')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-body">
                        <form  method="post" action="{{route('chains.storeSend')}}" >
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-3">
                                    <label for="date">{{ __('Date') }}</label>
                                    <input name="date" min="{{date('Y-m-d',strtotime('today'))}}" type="date" class="form-control" id="date" @error('date') is-invalid @enderror placeholder="{{ __('Date') }}" value="{{request()->input('date')}}" required>
                                    @error('date')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label for="date">{{ __("choisir l'Agence") }}</label>
                                    <select id="agency" name="agency" class="form-control mt-2 "
                                            data-toggle="select2" data-placeholder="{{ __("choisir l'Agence") }}">
                                        @foreach($agencies as $agency)
                                            <option @if(request()->input('agency_id') && request()->input('agency_id') == $agency->id) selected @endif data-value="{{$agency->num}}"
                                                    value="{{$agency->id}}">{{ __('Agence') }}
                                                : {{$agency->code}}|{{$agency->address}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(request()->input('qty'))
                                <div class="form-group mb-3 col-md-2">
                                    <label >{{ __('Quantité Demandé') }}</label>
                                    <input readonly type="text" class="form-control"  value="{{request()->input('qty')}}" >
                                </div>
                                    @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-2">
                                    <label for="start">{{ __('Stock') }}</label>
                                    <select id="receipts" class="selectpicker" data-style="btn-light" data-live-search="true" title="{{__('Selectionner un stock')}}">
                                        @foreach($receipts as $rec)
                                            <optgroup  label="{{$rec->receipt}}">
                                                @foreach(\App\Chain::lots($rec->receipt) as $lot)
                                                    <option data-receipt="{{$rec->receipt}}">{{$lot->min}} -> {{$lot->max}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-md-2">
                                    <label for="start">{{ __('Debut Numéro Carte') }}</label>
                                    <input name="start" type="text" class="form-control " id="start" @error('start') is-invalid @enderror placeholder="{{ __('Debut Numéro Carte') }}" value="{{old('start')}}" >
                                    @error('start')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-2">
                                    <label for="end">{{ __('Fin Numéro Carte') }}</label>
                                    <input name="end" type="text" class="form-control " id="end" @error('end') is-invalid @enderror placeholder="{{ __('Fin Numéro Carte') }}" value="{{old('end')}}" >
                                    @error('end')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-2">
                                    <label for="name_arab">{{ __('Quantité') }}</label>
                                    <input name="qty" type="text" class="form-control" id="qty" @error('qty') is-invalid @enderror placeholder="{{ __('Quantité') }}" >
                                    @error('qty')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group m-auto col-md-2">
                                    <button id="add" type="button" class="btn btn-success btn-lg mt-10">
                                        <i class="mdi mdi-plus-box"></i> {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="demo-foo-row-toggler" class="table table-bordered toggle-circle mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th> {{__('Bon de Commande')}} </th>
                                        <th> {{__('Debut Numéro Carte')}} </th>
                                        <th> {{__('Fin Numéro Carte')}} </th>
                                        <th> {{__('Quantité')}} </th>
                                        <th> {{__('Supprimer')}} </th>

                                    </tr>
                                    </thead>
                                    <tbody id="stock">
                                    </tbody>
                                    <td style="border: none" ></td>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td ><span id="qtys" class="badge label-table badge-success"></span></td>
                                </table>
                            </div> <!-- end .table-responsive-->

                            <div id="submit-container">
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
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script>
        $('#agency').select2();
        $('#receipts').selectpicker();


    </script>

    <script>
        $(document).ready(function () {
            $('#start').keyup(function () {
                let start = parseInt($(this).val());
                let end = parseInt($('#end').val());
                let test = testnum(start, end);
                if( test !== false ) {
                    $('#qty').val( test );
                } else {
                    console.log('erreur de nombre binomiale !!');
                }
            });
            $('#end').keyup(function () {
                let start = parseInt($("#start").val());
                let end = parseInt($(this).val());
                let test = testnum(start, end);
                if( test !== false ) {
                    $('#qty').val( test );
                } else {
                    console.log('erreur de nombre binomiale !!');
                }
            });
        });
        function testnum(debut,fin) {
            if (debut>fin) {
                return false;
            } else {
                return fin - debut +1 ;
            }
        }
    </script>

    <script>
        let lots = [];
        let random = 0;
        $('#add').click(function () {
            if (verifAdd()) {
                $('#stock').append(
                    '<tr>'+
                    '<td>'+$('#receipts').val()+'</td>'+
                    '<td>'+$('#start').val()+'</td>'+
                    '<td>'+$('#end').val()+'</td>'+
                    '<td class="qty_number" >'+$('#qty').val()+'</td>'+
                    '<td> <button id="delete" data-id="'+$('#receipts').val()+'" type="button" class="btn btn-danger ">' +
                    '<i class="mdi mdi-delete"></i> {{ __('Supprimer') }}' +
                    '</button></td>'+
                    '<input type="hidden" name="send['+random+'][start]" value="'+$('#start').val()+'">'+
                    '<input type="hidden" name="send['+random+'][end]" value="'+$('#end').val()+'">'+
                    '</tr>'
                )
                random++;
                lots.push({id : $('#receipts option:selected').val(),text:$('#receipts option:selected').text(),rec : $('#receipts option:selected').attr('data-receipt')});
                $('#receipts option:selected').remove();
                $('.selectpicker').selectpicker("refresh");
                calculateQtys();
                $('#start').val('');
                $('#end').val('');
                $('#qty').val('');
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Invalid Form',
                    position: 'bottomRight'
                });
            }
            toggleContainer();

        });
        $('body').on('change','#receipts', function () {
            let selectedopt = $(this).val();
            let arr = selectedopt.split('->');
            let first = arr[0].trim();
            let last = arr[1].trim();
            $('#start').val(first);
            $('#end').val(last);
            let test = testnum(first, last);
            if( test !== false ) {
                $('#qty').val( test );
            } else {
                console.log('erreur de nombre binomiale !!');
            }
        });
        $('body').on('click','#delete', function () {
            let lotselected = $(this).attr('data-id');

            let addlot = lots.filter(function (v) {
                return v.id === lotselected;
            });

            $('#receipts').find('optgroup[label = "'+ addlot[0].rec +'"]').append(
                '<option data-receipt="'+ addlot[0].rec +'">'+ addlot[0].text +'</option>'
            )
            $('.selectpicker').selectpicker("refresh");
            $(this).parent().parent().remove();
            calculateQtys();
            toggleContainer();
            $('#start').val('');
            $('#end').val('');
            $('#qty').val('');
        });

        function verifAdd() {
            let selectedopt = $('#receipts').val();
            let arr = selectedopt.split('->');
            let first = arr[0].trim();
            let last = arr[1].trim();
            first = parseInt(first);
            last = parseInt(last);
            let pass = true;


            if ($('#receipts').val() === ''){
                pass = false;
            }
            if ($('#receipts option').length === 0){
                pass = false;
            }
            if (!((parseInt($('#start').val()) >= first) && (parseInt($('#start').val()) <= last))) {
                pass = false;
            }
            if (!((parseInt($('#end').val()) >= first) && (parseInt($('#end').val()) <= last))) {
                pass = false;
            }
            if ($('#start').val() === ''){
                pass = false;
            }
            if ($('#end').val() === ''){
                pass = false;
            }
            if (parseInt($('#start').val()) > parseInt($('#end').val())) {
                pass = false;
            }
            if ($('#qty').val() === ''){
                pass = false;
            }
            return pass;
        }
        function calculateQtys() {
            let qtysum = 0;
            $('.qty_number').each(function () {
                qtysum += parseInt($(this).text());
            });
            $('#qtys').text(qtysum);

        }
        function toggleContainer() {
            let check = $('#stock tr').length > 0;

            if (check) {
                $('#submit-container').html(`<button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>`);
            } else {
                $('#submit-container').html('');
            }

        }
    </script>


@endsection
