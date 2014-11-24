<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.admin.title') — {{ isset( $title ) ? $title : Lang::get('menu.home') }}</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet"> -->
    <link href="/assets/css/bootstrap-flatly.css" rel="stylesheet">
    @if( ! is_null( $styles ) && ! empty( $styles ) )
    @foreach( $styles as $style )
    <link href="{{ $style }}" rel="stylesheet">
    @endforeach
    @endif
    <link href="/assets/css/style.css?t={{ time() }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @include('admin.parts.menu')

    <div class="container-fluid">
    {{ $content }}
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    @if( ! is_null( $inline_js ) && ! empty( $inline_js ) )
    <script type="text/javascript">{{ $inline_js }}</script>
    @endif
    <script src="/assets/js/main.js"></script>
    @if( ! is_null( $scripts ) && ! empty( $scripts ) )
    @foreach( $scripts as $script )
    <script src="{{ $script }}"></script>
    @endforeach
    @endif

    <script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?sensor=false&#038;ver=4.0'></script>
<script type="text/javascript">
    jQuery( function() {
    $ = jQuery.noConflict();
    $ajaxLoader = '<div class="ajax-loader"></div>';

    // Localization variable = RESTAURANTMETABOXESL10n

    if( $('#geolocation_address').length ) {
        var address   = $('#geolocation_address').val();
        var latitude  = $('#geolocation_latitude').val();
        var longitude = $('#geolocation_longitude').val();

        var latlng = ( latitude == '' && longitude == '' ) ? new google.maps.LatLng( 50.833, 4.333 ) : new google.maps.LatLng( latitude, longitude );
        var map = new google.maps.Map( document.getElementById( 'geolocation-google-map' ), {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl: 0,
            zoomControl: 0,
            mapTypeControl: 0,
            scaleControl: 0,
            streetViewControl: 0,
            overviewMapControl: 0
        });
        console.log( map );

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true,
        });

        map.addListener(marker, 'drag', function() {
            var pos = marker.getPosition();
            $( '#geolocation_latitude' ).val(pos.lat());
            $( '#geolocation_latitude_shown' ).val(pos.lat());
            $( '#geolocation_longitude' ).val(pos.lng());
            $( '#geolocation_longitude_shown' ).val(pos.lng());
        });

        $(document).on('change, keyup', '#geolocation_address', function(e) {
            var $this = $(this);
            if( $this.val() != '' && $this.val().length >= 3 ) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ address: $this.val() }, function(results, status) {
                    if( status == google.maps.GeocoderStatus.OK ) {
                        var pos = results[0].geometry.location;
                        map.setCenter(pos);
                        marker.setPosition(pos);
                        if( map.getZoom() < 12 ) {
                            map.setZoom(12);
                        }
                        $('#geolocation-new-coordinates').show();

                        $( '#geolocation_new_latitude' ).val(results[0].geometry.location.lat());
                        $( '#geolocation_new_longitude' ).val(results[0].geometry.location.lng());
                    }
                });
            }
        });

        $(document).on("click", "#geolocation-use-new", function(e) {
            e.preventDefault();

            $( '#geolocation_latitude' ).val($( '#geolocation_new_latitude' ).val());
            $( '#geolocation_latitude_shown' ).val($( '#geolocation_new_latitude' ).val());
            $( '#geolocation_longitude' ).val($( '#geolocation_new_longitude' ).val());
            $( '#geolocation_longitude_shown' ).val($( '#geolocation_new_longitude' ).val());
        })
    }
} );
</script>
  </body>
</html>