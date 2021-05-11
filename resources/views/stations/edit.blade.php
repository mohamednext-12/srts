@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">Validation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Modifier la Station') .$station->name_french}} </h4>
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
                        <form class="needs-validation" novalidate method="POST" action="{{ route('stations.update',$station->id) }}">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name_french">{{ __('Nom Francais') }}</label>
                                <input name="name_french" type="text" class="form-control" id="name_french" @error('name_french') is-invalid @enderror placeholder="{{ __('Nom Francais') }}" value="{{$station->name_french}}" required>
                                @error('name_french')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name_arab">{{ __('Nom Arabe') }}</label>
                                <input name="name_arab" type="text" class="form-control" id="name_arab" @error('name_arab') is-invalid @enderror placeholder="{{ __('Nom Arabe') }}" value="{{$station->name_arab}}" required>
                                @error('name_arab')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom02">{{ __('Numéro') }}</label>
                                <input name="num" type="text" class="form-control" id="validationCustom01" @error('num') is-invalid @enderror placeholder="{{ __('Numéro') }}" value="{{$station->num}}" required>
                                @error('num')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="house_address">Adresse</label>
                                        <input required type="text" name="address" class="form-control"
                                               id="house_address"
                                               placeholder="Saisir l'adresse">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="map" class="map-section-map" style="height: 400px!important;padding-bottom: 0;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Saisir les coordonnées geographique</label>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="house_lat">Latitude</label>
                                        <input type="text" class="form-control" placeholder="Saisir la Latitude.." name="lat" id="house_lat" value="{{$station->lat}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="house_lng">Longitude</label>
                                        <input type="text" class="form-control" placeholder="Saisir la Longitude.." name="long" id="house_lng" value="{{$station->long}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <button type="button" class="btn btn-primary btn-full-width" onclick="setMarker(true)" style="    margin-top: 30px">Trouver l'adresse
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold text-muted">Ligne(s)</p>
                                <select name="lines[]" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="{{ __('choisir les lignes') }}">
                                    @foreach($lines as $l)
                                        <option @if ($station->lineExist($l->id)) selected @endif value="{{$l->id}}">{{ __('Ligne numéro') }} : {{$l->num}}</option>>
                                    @endforeach
                                </select>


                            </div>

                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('stations.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
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
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
    <!-- Map Script -->
    <script>
        var map;
        var markersArray = [];
        var geocoder;
        function initMap() {
            var iconBase = "{{asset('assets/images/marker.png')}}";
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{$station->lat}}, lng: {{$station->long}}},
                zoom: 8,
                mapTypeId: 'roadmap',
                // styles: [
                //     {
                //         "featureType": "administrative",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "administrative",
                //         "elementType": "labels",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "administrative",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "administrative",
                //         "elementType": "labels.text.fill",
                //         "stylers": [
                //             {
                //                 "color": "#8a8a8a"
                //             },
                //             {
                //                 "visibility": "on"
                //             },
                //             {
                //                 "weight": "1"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "administrative.locality",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "administrative.neighborhood",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "color": "#f2f2f2"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "geometry",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             },
                //             {
                //                 "hue": "#00ff07"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "labels",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "labels.text.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.man_made",
                //         "elementType": "labels.icon",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.natural.landcover",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.natural.landcover",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.natural.landcover",
                //         "elementType": "labels.text.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "landscape.natural.landcover",
                //         "elementType": "labels.icon",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.attraction",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.attraction",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.attraction",
                //         "elementType": "geometry.stroke",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.attraction",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.attraction",
                //         "elementType": "labels.icon",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.business",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "poi.park",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             },
                //             {
                //                 "hue": "#15ff00"
                //             },
                //             {
                //                 "saturation": "12"
                //             },
                //             {
                //                 "lightness": "18"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "saturation": -100
                //             },
                //             {
                //                 "lightness": 45
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.highway",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "simplified"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.highway",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "color": "#ffffff"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.highway",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.arterial",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "color": "#ffffff"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.arterial",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.arterial",
                //         "elementType": "labels.icon",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.local",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             },
                //             {
                //                 "color": "#ffffff"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "road.local",
                //         "elementType": "labels.text",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "transit",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             },
                //             {
                //                 "color": "#dcdbdb"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "transit.line",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             },
                //             {
                //                 "lightness": "21"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "transit.line",
                //         "elementType": "geometry.stroke",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "transit.station.rail",
                //         "elementType": "geometry.fill",
                //         "stylers": [
                //             {
                //                 "visibility": "off"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "transit.station.rail",
                //         "elementType": "geometry.stroke",
                //         "stylers": [
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     },
                //     {
                //         "featureType": "water",
                //         "elementType": "all",
                //         "stylers": [
                //             {
                //                 "color": "#97dbf6"
                //             },
                //             {
                //                 "visibility": "on"
                //             }
                //         ]
                //     }
                // ]
            });
            geocoder = new google.maps.Geocoder();
            var marker = new google.maps.Marker({
                position: {lat: {{$station->lat}}, lng: {{$station->long}}},
                map: map,
                center:{lat: {{$station->lat}}, lng: {{$station->long}}},
                icon: iconBase,
                draggable:true,
                zoom:8,
            });
            markersArray.push(marker);
            google.maps.event.addListener(marker, 'dragend', function (event) {
                document.getElementById("house_lat").value = this.getPosition().lat();
                document.getElementById("house_lng").value = this.getPosition().lng();
                setMarker(false);
            });

            //Make Google Place
            let input = document.getElementById('house_address');
            let ac = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(ac, 'place_changed', function () {
                var place = ac.getPlace();
                $('#house_lat').val(place.geometry.location.lat());
                $('#house_lng').val(place.geometry.location.lng());
                setMarker(false);
            });
        }

        function clearOverlays() {
            for (var i = 0; i < markersArray.length; i++ ) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }

        function setMarker(withscroll = false) {
            let lat = $('#house_lat').val();
            let lng = $('#house_lng').val();
            if ((lat != '') && (lng !='')) {
                lat = parseFloat(lat);
                lng = parseFloat(lng);
                markersArray[0].setPosition({lat,lng});
                map.panTo( new google.maps.LatLng( lat, lng ) );
                geocodeLatLng(geocoder,map,lat,lng,function (addr) {
                    $('#house_address').val(addr);
                    $('#address-place').text(addr != '' ? addr : 'Adresse');
                });
                if (withscroll) {scrollSmooth();}
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Veuiller Remplir Les coordonnes géorgaphiques',
                    position: 'bottomRight'
                });
            }
        }

        function geocodeLatLng(geocoder, map,lat,lng,callback) {
            const latlng = {
                lat,
                lng
            };
            geocoder.geocode({ location: latlng }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        console.log(results[0]);
                        callback(results[1].formatted_address);
                    } else {
                        window.alert("No results found");
                        callback('');
                    }
                } else {
                    window.alert("Geocoder failed due to: " + status);
                    callback('');
                }
            });

        }

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1WXfQV2SeRlO-P9qYwMZvcCLrb2r1zA&callback=initMap&libraries=places"
            async defer></script>
@endsection
