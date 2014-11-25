/*
 * Fancy Select (3.5 kb minified)
 * http://code.octopuscreative.com/fancyselect/
 */
(function(){var a;a=window.jQuery||window.Zepto||window.$;a.fn.fancySelect=function(d){var c,b;if(d==null){d={}}b=a.extend({forceiOS:false,includeBlank:false,optionTemplate:function(e){return e.text()},triggerTemplate:function(e){return e.text()}},d);c=!!navigator.userAgent.match(/iP(hone|od|ad)/i);return this.each(function(){var e,i,g,j,f,h,k;j=a(this);if(j.hasClass("fancified")||j[0].tagName!=="SELECT"){return}j.addClass("fancified");j.css({width:1,height:1,display:"block",position:"absolute",top:0,left:0,opacity:0});j.wrap('<div class="fancy-select">');k=j.parent();if(j.data("class")){k.addClass(j.data("class"))}k.append('<div class="trigger">');if(!(c&&!b.forceiOS)){k.append('<ul class="options">')}f=k.find(".trigger");g=k.find(".options");i=j.prop("disabled");if(i){k.addClass("disabled")}h=function(){var l;l=b.triggerTemplate(j.find(":selected"));return f.html(l)};j.on("blur.fs",function(){if(f.hasClass("open")){return setTimeout(function(){return f.trigger("close.fs")},120)}});f.on("close.fs",function(){f.removeClass("open");return g.removeClass("open")});f.on("click.fs",function(){var l,m;if(!i){f.toggleClass("open");if(c&&!b.forceiOS){if(f.hasClass("open")){return j.focus()}}else{if(f.hasClass("open")){m=f.parent();l=m.offsetParent();if((m.offset().top+m.outerHeight()+g.outerHeight()+20)>a(window).height()+a(window).scrollTop()){g.addClass("overflowing")}else{g.removeClass("overflowing")}}g.toggleClass("open");if(!c){return j.focus()}}}});j.on("enable",function(){j.prop("disabled",false);k.removeClass("disabled");i=false;return e()});j.on("disable",function(){j.prop("disabled",true);k.addClass("disabled");return i=true});j.on("change.fs",function(l){if(l.originalEvent&&l.originalEvent.isTrusted){return l.stopPropagation()}else{return h()}});j.on("keydown",function(n){var m,o,l;l=n.which;m=g.find(".hover");m.removeClass("hover");if(!g.hasClass("open")){if(l===13||l===32||l===38||l===40){n.preventDefault();return f.trigger("click.fs")}}else{if(l===38){n.preventDefault();if(m.length&&m.index()>0){m.prev().addClass("hover")}else{g.find("li:last-child").addClass("hover")}}else{if(l===40){n.preventDefault();if(m.length&&m.index()<g.find("li").length-1){m.next().addClass("hover")}else{g.find("li:first-child").addClass("hover")}}else{if(l===27){n.preventDefault();f.trigger("click.fs")}else{if(l===13||l===32){n.preventDefault();m.trigger("click.fs")}else{if(l===9){if(f.hasClass("open")){f.trigger("close.fs")}}}}}}o=g.find(".hover");if(o.length){g.scrollTop(0);return g.scrollTop(o.position().top-12)}}});g.on("click.fs","li",function(m){var l;l=a(this);j.val(l.data("raw-value"));if(!c){j.trigger("blur.fs").trigger("focus.fs")}g.find(".selected").removeClass("selected");l.addClass("selected");f.addClass("selected");return j.val(l.data("raw-value")).trigger("change.fs").trigger("blur.fs").trigger("focus.fs")});g.on("mouseenter.fs","li",function(){var m,l;l=a(this);m=g.find(".hover");m.removeClass("hover");return l.addClass("hover")});g.on("mouseleave.fs","li",function(){return g.find(".hover").removeClass("hover")});e=function(){var l;h();if(c&&!b.forceiOS){return}l=j.find("option");return j.find("option").each(function(n,m){var o;m=a(m);if(!m.prop("disabled")&&(m.val()||b.includeBlank)){o=b.optionTemplate(m);if(m.prop("selected")){return g.append('<li data-raw-value="'+(m.val())+'" class="selected">'+o+"</li>")}else{return g.append('<li data-raw-value="'+(m.val())+'">'+o+"</li>")}}})};j.on("update.fs",function(){k.find(".options").empty();return e()});return e()})}}).call(this);


jQuery(document).ready(function($) {

console.log('========================');
console.log('Document ready');
// ------------------------------------------------------------
// FancySelect
// ------------------------------------------------------------

$('.custom-select').fancySelect();

// ------------------------------------------------------------
// Jquery Ending
// ------------------------------------------------------------

});


    var category = 0;
    var yearfrom = 0;
    var yearto = 0;
    var lattop = 0;
    var lngtop = 0;
    var latbottom = 0;
    var lngbottom = 0;
    var movietype = 0;
    
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
            var $this = $(this);
            href = $this.attr( 'href' );

            $('#slideRight .modal-body').load(href + ' #content');
            $('#slideRight').modal();
        
            return false;
        } );

        $(document).on('click', '.addCard', function(e) {
            e.preventDefault();

            $('#addCard').modal();
        
            return false;
        } );

        $(document).on('change', '#category-selector', function(e) {
            var $this = $(this);
            category = $this.val();
            makeSentence();
        } );
        $(document).on('change', '#type-selector', function(e) {
            var $this = $(this);
            movietype = $this.val();
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
                zoomControl: true,
                mapTypeControl: 0,
                scaleControl: true,
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
        console.log(sentence);
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
                    title: markers[i][0],
                    icon: "assets/img/zoom-0.png"
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
