@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div class="col-md-8">
    <div id="google-map" style="width: 800px; height: 550px"></div>
</div>
<div class="col-md-4">
    <h3>Categories :</h3>
    <ul>
      @if( ! is_null( $categories ) && ! empty( $categories ) )
        @foreach( $categories as $category )
        <li><a href="#" class="category-selector" data-id="{{ $category->id }}">{{ $category->title }}</a></li>
        @endforeach
        <li><a href="#" class="category-selector" data-id="0">Toutes</a></li>
      @endif
    </ul>

    <h3>Années :</h3>
    De : <input type="number" id="yearfrom" value="2010" /><br>
    À : <input type="number" id="yearto" value="2015" /><br>

    <h3>Apply</h3>
    <button id="apply">Appliquer</button>

    <h3>Results</h3>
    <div id="sentence"></div>
</div>
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Ajouter une fiche</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?sensor=false&#038;ver=4.0'></script>
<script type="text/javascript">

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

</script>