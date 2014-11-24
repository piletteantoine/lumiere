@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div id="google-map" class="map"></div>

<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?sensor=false&#038;ver=4.0'></script>
<script type="text/javascript">
    var map;
    var markers;
    var infowindows;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    jQuery( function() {
        $ = jQuery.noConflict();
        $ajaxLoader = '<div class="ajax-loader"></div>';

        var latlng = new google.maps.LatLng( 50.833, 4.333 );
        map = new google.maps.Map( document.getElementById( 'google-map' ), {
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


    });

    function getCards(category, lattop, lngtop, latbottom, lngbottom, yearfrom, yearto){

        $parameters = {
            'count': 0
        };

        if( typeof( category ) != 'undefined' && category > 0 ) {
            $.extend( $parameters, {'category': category} );
        }

        if( typeof( lattop ) != 'undefined' && lattop > 0 ) {
            $.extend( $parameters, {'lattop': lattop} );
        }

        if( typeof( lngtop ) != 'undefined' && lngtop > 0 ) {
            $.extend( $parameters, {'lngtop': lngtop} );
        }

        if( typeof( latbottom ) != 'undefined' && latbottom > 0 ) {
            $.extend( $parameters, {'latbottom': latbottom} );
        }

        if( typeof( category ) != 'undefined' && category > 0 ) {
            $.extend( $parameters, {'category': category} );
        }

        if( typeof( lngbottom ) != 'undefined' && lngbottom > 0 ) {
            $.extend( $parameters, {'lngbottom': lngbottom} );
        }

        if( typeof( yearfrom ) != 'undefined' && yearfrom > 0 ) {
            $.extend( $parameters, {'yearfrom': yearfrom} );
        }

        if( typeof( yearto ) != 'undefined' && yearto > 0 ) {
            $.extend( $parameters, {'yearto': yearto} );
        }

        $.get( '/rest/cards', $parameters, function( data ) {

            // Multiple Markers
            markers = [];
            infowindows = [];

            // Browse
            $.each( data.cards, function( index, element ) {
                
                markers.push([element.title, element.location_lat, element.location_long])
                infowindows.push( [ '<h2>' + element.title + '</h2><p>' + element.description + '</p>' ] );
                
                console.log( markers );
                console.log( infowindows ); 
            });

            // Display multiple markers on a map
            var infowindow = new google.maps.InfoWindow(), marker, i;
            
            // Loop through our array of markers & place each one on the map  
            for( i = 0; i < markers.length; i++ ) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0]
                });
                
                // Allow each marker to have an info window    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(infowindows[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
            }
        });
    }

    getCards();

</script>