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

        $(document).on('click', '.ajax', function(e) {
            e.preventDefault();

            var $this = $(this);
            href = $this.attr( 'href' );

            $('#add .modal-body').load(href + ' #content');
            $('#add').modal();
        
            return false;
        } );

        $(document).on('click', '.category-selector', function(e) {
            var $this = $(this);
            category = $this.data('id');
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
    });

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
