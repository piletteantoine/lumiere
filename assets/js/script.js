// ------------------------------------------------------------
// PLUGINS
// ------------------------------------------------------------

// ------------------------------------------------------------
// DOCUMENT READY
// ------------------------------------------------------------

// This ready handler passes the jQuery alias in to avoid conflict with other libraries.

jQuery(document).ready(function($) {

console.log('========================');
console.log('Document ready');


// ------------------------------------------------------------
// GLOBAL VARIABLES
// ------------------------------------------------------------

var _window = $(window),
	$scroll_position_onload = $(document).scrollTop(),
	$body = $('body');


// ------------------------------------------------------------
// FancySelect
// ------------------------------------------------------------

$('.custom-select').fancySelect();


// ------------------------------------------------------------
// Google map
// ------------------------------------------------------------

(function() {
	if($('#map')[0]) {
	  var style = [
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
	                "color": "#131314"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "stylers": [
	            {
	                "color": "#131313"
	            },
	            {
	                "lightness": 7
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
	                "lightness": 25
	            }
	        ]
	    }
	]

	// Init the Map 
	var map = new google.maps.Map(document.getElementById('map_canvas'), {
	  zoom: 12,
	  // center: new google.maps.LatLng(10, 10),
	  center:  new google.maps.LatLng(51.48184, 7.21624),
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  styles: style
	});

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('GET', 'ruhr.svg', false);
	xmlhttp.send();


	var overlay = new SvgOverlay({
	  content: xmlhttp.responseText,
	  map: map
	});

	var svg = overlay.getSvg();

	svg.setAttribute('opacity', 1);
	var bounds = new google.maps.LatLngBounds();


	var markers = [
		  ['Castelluci - Bochum', 51.48184,7.21624],
		  ['Barney - Essen', 51.455643,7.011555],
		  ['Feldman - Dortmund', 51.51359,7.46530]
	 ];

	// Create our info window content   
	  var infoWindowContent = [
		['<div class="info_content">' +
		'<h3>Castelluci - Bochum</h3>' + 
		'</div>'],
		['<div class="info_content">' +
		'<h3>Barney - Essen</h3>' + 
		'</div>'],
		['<div class="info_content">' +
		'<h3>Feldman - Dortmund</h3>' 
		+ '</div>']
	];


   // InfoWindow Styling Here 
	   var infoWindow = new google.maps.InfoWindow(), marker, i;

		google.maps.event.addListener(infoWindow, 'domready', function() {
			 var l = $('#info_content').parent().parent().parent().parent();
			 for (var i = 0; i < l.length; i++) {
				 if($(l[i]).css('z-index') == 'auto') {
					 $(l[i]).css('text-align', 'center');
					 $(l[i]).css('font-size', '17px');
					 $(l[i]).css('cursor', 'pointer');
				 }
			 }
		 });

	// var infoWindow = new google.maps.InfoWindow(), marker, i;

	//
	// Add the markers and infowindows to the map
	// Source: http://stackoverflow.com/questions/21514388/google-maps-api-open-multiple-info-windows-by-default
	// ------------------------------------------

	for (var i = 0; i < markers.length; i++) {
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(markers[i][1], markers[i][2]), // Lat - Lon
			map: map
		});

		var icon = 'M1.7317647058823529';

		marker.setIcon({
		  anchor: new google.maps.Point(0.85, 0.85),
		  path: icon
		});

		var infowindow = new google.maps.InfoWindow({
		  content: markers[i][0], // Name
		  maxWidth: 160
		});
		infowindow.open(map, marker);
	}


	//
	// Click on info window
	// --------------------

	var info_window_target = $('#info_content');

	$(document).on('click', info_window_target, function()
	{
		$('#map-sidebar').toggleClass('off-canvas');
	});

	google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
	  infoWindow.open(map, marker);
	});
	infoWindow.open(map,marker);

	var img = document.getElementById('canvas');

	function drawing_map(){

	  var center = new google.maps.LatLng(0,0),
		// compute map offset
		projection = overlay.getProjection(),
		divPixel = projection.fromLatLngToDivPixel(center),
		containerPixel = projection.fromLatLngToContainerPixel(center),


		x = divPixel.x - containerPixel.x - left,
		y = divPixel.y - containerPixel.y - top,

		// create new svg container
		svg = overlay.getSvg().cloneNode(true),
		xml = document.implementation.createDocument(),
		div = document.createElement('div'),
		wrapper = xml.createElement('svg'),

		// get map dimension
		mapDiv = map.getDiv(),
		width = mapDiv.clientWidth,
		height = mapDiv.clientHeight,

		// set svg clipping
		viewBox = [x, y, width, height].join(' '),

		DOMURL = self.URL || self.webkitURL || self,
		blob, url;


	  wrapper.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
	  wrapper.setAttribute('width', width);
	  wrapper.setAttribute('height', height);
	  wrapper.setAttribute('viewBox', viewBox);

	  wrapper.appendChild(svg);
	  div.appendChild(wrapper);

	  var icon = marker.getIcon(),
		path = xml.createElement('path'),
		point = projection.fromLatLngToDivPixel(marker.getPosition());

	  point.x -= icon.scale * icon.anchor.x + left;
	  point.y -= icon.scale * icon.anchor.y + top;

	  path.setAttribute('d', icon.path);
	  path.setAttribute('transform', 'translate(' + point.x + ',' + point.y + ') scale(' + icon.scale + ')');
	  path.setAttribute('fill', icon.fillColor);
	  path.setAttribute('stroke', icon.strokeColor);
	  path.setAttribute('fill-opacity', icon.fillOpacity);
	  path.setAttribute('stroke-opacity', icon.strokeOpacity);
	  path.setAttribute('stroke-width', icon.strokeWeight);
	  path.setAttribute('vector-effect', 'non-scaling-stroke');

	  wrapper.appendChild(path);


	  blob = new Blob([div.innerHTML], {
		type: 'image/svg+xml;charset=utf-8'
	  });

	  url = DOMURL.createObjectURL(blob);
	  console.log(url);

	  img.src = url;
	}
}
})();


// ------------------------------------------------------------
// Map: draggable slider
// ------------------------------------------------------------

// var dragger = new Dragdealer('demo-simple-slider', {
// 	right: 35,
// 	left: -5,
// 	callback: function(x, y) {
// 		console.log(x);
// 	}
// });


// ------------------------------------------------------------
// Map: Image slider
// ------------------------------------------------------------

var $map_sidebar_slider = $('#map-sidebar-slider');

$map_sidebar_slider.unslider(
{
	speed		: 500,
	delay		: 4000,
	keys		: true,
	dots 		: true,

});


// ------------------------------------------------------------
// Main navigation: search bar
// ------------------------------------------------------------

(function() {

	var $search_trigger = $('#search-trigger'),
		$search_bar		= $('#search-bar'),
		$main_nav		= $('#navigation'),
		$content 		= $('#content'),
		$search_field	= $('#search-field');

	$search_trigger.click(function()
	{
		console.log('========================');
		console.log('Search trigger clicked');
		$search_trigger.toggleClass('triggered');
		$main_nav.add($content).toggleClass('make-room');
		$search_bar.toggleClass('visible');
		($search_bar.hasClass('visible')) ? $search_field.focus() : $search_field.blur();
	});

})();


// ------------------------------------------------------------
// Responsive slider
// ------------------------------------------------------------

// Gets total amount of slides
var count 				= $(".overview__slide").length,
	$slides_container 	= $(".overview__slide-container"),
	$slides 			= $(".overview__slide"),
	n_interval_id,
	$slide_index		= 0;

console.log(count, 'slides');

//
// When clicking the NEXT button
// -----------------------------

$('.overview__controls .next').click(function(e)
{
	e.preventDefault();

	var $slide_width,
		$show,
		$target_slide_index = $slide_index +1,
		$target_slide = $slide_index +2;

	// 1 slide at once
	if (_window.width() < 480) {
		$slide_width = 100;
		$show = 'one';
	}
	// 2 slide at once
	else if (_window.width() <= 1024) {
		$slide_width = 50;
		$show = 'two';
	}
	// 3 slides at once
	else {
		$slide_width = 33.33;
		$show = 'three';
	}

	switch($show) {
		case ('one'):
			if($target_slide_index == count) // The last slide is visible
			{
				$slide_index = 0;
			}
			else {
				$slide_index++;
			}
			break;
		case ('two'):
			if($target_slide_index == count -1) // The last slide is visible
			{
				$slide_index = 0;
			}
			else {
				$slide_index++;
			}
			break;
		case ('three'): 
			if($target_slide_index == count -2) // The last slide is visible
			{
				$slide_index = 0;
			}
			else {
				$slide_index++;
			}
			break;
	}

	console.log('$target_slide_index is', $target_slide_index);

	$slides_container.css({
		marginLeft: $slide_index * -($slide_width) + '%'
	});
});

// ------------------------------------------------------------
// End jQuery
// ------------------------------------------------------------

});