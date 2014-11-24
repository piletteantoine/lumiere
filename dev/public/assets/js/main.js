    var category = 0;
    var yearfrom = 0;
    var yearto = 0;
    var lattop = 0;
    var lngtop = 0;
    var latbottom = 0;
    var lngbottom = 0;
    
    var map;
    var markers = [];
    var mapMarkers = [];
    var infowindows;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    jQuery( function() {
        var styles = [
                {
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "stylers": [
                        {
                            "color": "#121212"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [
                        {
                            "color": "#121212"
                        },
                        {
                            "lightness": 0
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "stylers": [
                        {
                            "color": "#121212"
                        },
                        {
                            "lightness": 35
                        }
                    ]
                    },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "lightness": 100
                        }
                    ]
                }
            ]
        $ = jQuery.noConflict();
        $ajaxLoader = '<div class="ajax-loader"></div>';

        var latlng = new google.maps.LatLng( 50.833, 4.333 );
        map = new google.maps.Map( document.getElementById( 'google-map' ), {
            zoom: 3,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl: 0,
            zoomControl: 0,
            mapTypeControl: 0,
            scaleControl: 1,
            streetViewControl: 0,
            'styles': styles,
            overviewMapControl: 0
        });

        $(document).on('click', '.ajax', function(e) {
            e.preventDefault();

            var $this = $(this);
            href = $this.attr( 'href' );

            $('#ajax .modal-body').load(href + ' #content');
            $('#ajax').modal();
        
            return false;
        } );

        $(document).on('click', '.slideRight', function(e) {
            e.preventDefault();

            $('#slideRight').modal();
        
            return false;
        } );

        $(document).on('click', '.category-selector', function(e) {
            var $this = $(this);
            category = $this.data('id');
            makeSentence();
        } );

        $(document).on('change, keyup', '#yearfrom', function(e) {
            var $this = $(this);
            if( $this.val() != '' && $this.val().length >= 4 ) {
                yearfrom = $this.val();
            }
        });
        $(document).on('change, keyup', '#yearto', function(e) {
            var $this = $(this);
            if( $this.val() != '' && $this.val().length >= 4 ) {
                yearto = $this.val();
                if(typeof(yearfrom) != 'undefined' && yearfrom > yearto) yearto = yearfrom;
                if(typeof(yearfrom) == 'undefined' || yearfrom == 0) yearfrom = yearto;
            }
        });

        $(document).on('click', '#apply', function(e) {
            makeSentence();
            getCards();
        });

        if( $('#geolocation_address').length ) {
            var address   = $('#geolocation_address').val();
            var latitude  = $('#geolocation_latitude').val();
            var longitude = $('#geolocation_longitude').val();

            var latlng = ( latitude == '' && longitude == '' ) ? new google.maps.LatLng( 50.833, 4.333 ) : new google.maps.LatLng( latitude, longitude );
            var mapadd = new google.maps.Map( document.getElementById( 'geolocation-google-map' ), {
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
            
            var marker = new google.maps.Marker({
                position: latlng,
                map: mapadd,
                draggable: true,
            });

            mapadd.addListener(marker, 'drag', function() {
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
                            mapadd.setCenter(pos);
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

        $(function() {
            $( "#slider" ).slider({
                  range: true,
                  min: 1980,
                  max: 2015,
                  values: [ 2000, 2014 ],
                  slide: function( event, ui ) {
                    yearfrom = ui.values[ 0 ];
                    yearto = ui.values[ 1 ];
                    makeSentence();
                    $("#slider").find(".ui-slider-handle").first().text(yearfrom);
                    $("#slider").find(".ui-slider-handle").last().text(yearto);
                  },
                  create: function( event, ui ) {
                    yearfrom = 2000;
                    yearto = 2014;
                    makeSentence();
                    console.log('test');
                    $("#slider").find(".ui-slider-handle").first().text(yearfrom);
                    $("#slider").find(".ui-slider-handle").last().text(yearto);
                  }
            });
        });
    });

$('.custom-select').fancySelect();
    

    function makeSentence(){
        var sentence = "Votre recherche actuelle liste les films";
        if( typeof(yearfrom) && yearfrom > 0 ) {
            if( typeof(yearto) && yearto > 0 ) {
                if( yearfrom == yearto ) {
                    sentence += " en " + yearfrom;
                } else {
                    sentence += " entre " + yearfrom + " et " + yearto;
                }
            } else {
                sentence += " en " + yearfrom;
            }
        }
            
        if( typeof(category) && category > 0 ) sentence += " dans la catégorie " + category;

        sentence += ".";
        $('#sentence').text(sentence);

        getCards();
    }

    function getCards(){

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

        var marker, i;

        $.get( '/rest/cards', $parameters, function( data ) {

            if(mapMarkers.length > 0){
                for( i = 0; i < mapMarkers.length; i++ ){
                    mapMarkers[ i ].setMap(null);
                }
            }
            mapMarkers = [];

            // Multiple Markers
            markers = [];
            infowindows = [];
            
            // Browse
            $.each( data.cards, function( index, element ) {
                
                markers.push([element.title, element.location_lat, element.location_long])
                infowindows.push( [ '<h2>' + element.title + '</h2><p>' + element.description + '</p>' ] );
            });

            // Display multiple markers on a map
            var infowindow = new google.maps.InfoWindow();
            
            // Loop through our array of markers & place each one on the map  
            for( i = 0; i < markers.length; i++ ) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0]
                });
                mapMarkers.push(marker);
                
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
