// ------------------------------------------------------------
// PLUGINS
// ------------------------------------------------------------

/*
 * Fancy Select (3.5 kb minified)
 * http://code.octopuscreative.com/fancyselect/
 */
(function(){var a;a=window.jQuery||window.Zepto||window.$;a.fn.fancySelect=function(d){var c,b;if(d==null){d={}}b=a.extend({forceiOS:false,includeBlank:false,optionTemplate:function(e){return e.text()},triggerTemplate:function(e){return e.text()}},d);c=!!navigator.userAgent.match(/iP(hone|od|ad)/i);return this.each(function(){var e,i,g,j,f,h,k;j=a(this);if(j.hasClass("fancified")||j[0].tagName!=="SELECT"){return}j.addClass("fancified");j.css({width:1,height:1,display:"block",position:"absolute",top:0,left:0,opacity:0});j.wrap('<div class="fancy-select">');k=j.parent();if(j.data("class")){k.addClass(j.data("class"))}k.append('<div class="trigger">');if(!(c&&!b.forceiOS)){k.append('<ul class="options">')}f=k.find(".trigger");g=k.find(".options");i=j.prop("disabled");if(i){k.addClass("disabled")}h=function(){var l;l=b.triggerTemplate(j.find(":selected"));return f.html(l)};j.on("blur.fs",function(){if(f.hasClass("open")){return setTimeout(function(){return f.trigger("close.fs")},120)}});f.on("close.fs",function(){f.removeClass("open");return g.removeClass("open")});f.on("click.fs",function(){var l,m;if(!i){f.toggleClass("open");if(c&&!b.forceiOS){if(f.hasClass("open")){return j.focus()}}else{if(f.hasClass("open")){m=f.parent();l=m.offsetParent();if((m.offset().top+m.outerHeight()+g.outerHeight()+20)>a(window).height()+a(window).scrollTop()){g.addClass("overflowing")}else{g.removeClass("overflowing")}}g.toggleClass("open");if(!c){return j.focus()}}}});j.on("enable",function(){j.prop("disabled",false);k.removeClass("disabled");i=false;return e()});j.on("disable",function(){j.prop("disabled",true);k.addClass("disabled");return i=true});j.on("change.fs",function(l){if(l.originalEvent&&l.originalEvent.isTrusted){return l.stopPropagation()}else{return h()}});j.on("keydown",function(n){var m,o,l;l=n.which;m=g.find(".hover");m.removeClass("hover");if(!g.hasClass("open")){if(l===13||l===32||l===38||l===40){n.preventDefault();return f.trigger("click.fs")}}else{if(l===38){n.preventDefault();if(m.length&&m.index()>0){m.prev().addClass("hover")}else{g.find("li:last-child").addClass("hover")}}else{if(l===40){n.preventDefault();if(m.length&&m.index()<g.find("li").length-1){m.next().addClass("hover")}else{g.find("li:first-child").addClass("hover")}}else{if(l===27){n.preventDefault();f.trigger("click.fs")}else{if(l===13||l===32){n.preventDefault();m.trigger("click.fs")}else{if(l===9){if(f.hasClass("open")){f.trigger("close.fs")}}}}}}o=g.find(".hover");if(o.length){g.scrollTop(0);return g.scrollTop(o.position().top-12)}}});g.on("click.fs","li",function(m){var l;l=a(this);j.val(l.data("raw-value"));if(!c){j.trigger("blur.fs").trigger("focus.fs")}g.find(".selected").removeClass("selected");l.addClass("selected");f.addClass("selected");return j.val(l.data("raw-value")).trigger("change.fs").trigger("blur.fs").trigger("focus.fs")});g.on("mouseenter.fs","li",function(){var m,l;l=a(this);m=g.find(".hover");m.removeClass("hover");return l.addClass("hover")});g.on("mouseleave.fs","li",function(){return g.find(".hover").removeClass("hover")});e=function(){var l;h();if(c&&!b.forceiOS){return}l=j.find("option");return j.find("option").each(function(n,m){var o;m=a(m);if(!m.prop("disabled")&&(m.val()||b.includeBlank)){o=b.optionTemplate(m);if(m.prop("selected")){return g.append('<li data-raw-value="'+(m.val())+'" class="selected">'+o+"</li>")}else{return g.append('<li data-raw-value="'+(m.val())+'">'+o+"</li>")}}})};j.on("update.fs",function(){k.find(".options").empty();return e()});return e()})}}).call(this);

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

	// Init the Map 
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 3,
	  // center: new google.maps.LatLng(10, 10),
	  center:  new google.maps.LatLng(0, 0),
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  styles: style
	});



	 var markers = [];
	  for (var i = 0; i < 100; i++) {
	    var dataPhoto = data.photos[i];
	    var latLng = new google.maps.LatLng(dataPhoto.latitude,
	              dataPhoto.longitude);
	    var marker = new google.maps.Marker({
	      	position: latLng,
	      	icon: "assets/img/zoom-0.png"
	    });
	    markers.push(marker);
	  }

	  //set style options for marker clusters (these are the default styles)
	  var mcOptions = {styles: [{
	  height: 40,
	  url: "assets/img/zoom-1.png",
	  width: 40
	  },
	  {
	  height: 56,
	  url: "assets/img/zoom-2.png",
	  width: 56
	  },
	  {
	  height: 66,
	  url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m3.png",
	  width: 66
	  },
	  {
	  height: 78,
	  url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m4.png",
	  width: 78
	  },
	  {
	  height: 90,
	  url: "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m5.png",
	  width: 90
	  }]}

	  var markerCluster = new MarkerClusterer(map, markers, mcOptions);


	// var xmlhttp = new XMLHttpRequest();
	// xmlhttp.open('GET', 'ruhr.svg', false);
	// xmlhttp.send();


	// var overlay = new SvgOverlay({
	//   content: xmlhttp.responseText,
	//   map: map
	// });

	// var svg = overlay.getSvg();

	// svg.setAttribute('opacity', 1);
	// var bounds = new google.maps.LatLngBounds();


	// var markers = [
	// 	  ['Castelluci - Bochum', 51.48184,7.21624],
	// 	  ['Barney - Essen', 51.455643,7.011555],
	// 	  ['Feldman - Dortmund', 51.51359,7.46530]
	//  ];

	// // Create our info window content   
	//   var infoWindowContent = [
	// 	['<div class="info_content">' +
	// 	'<h3>Castelluci - Bochum</h3>' + 
	// 	'</div>'],
	// 	['<div class="info_content">' +
	// 	'<h3>Barney - Essen</h3>' + 
	// 	'</div>'],
	// 	['<div class="info_content">' +
	// 	'<h3>Feldman - Dortmund</h3>' 
	// 	+ '</div>']
	// ];


 //   // InfoWindow Styling Here 
	//    var infoWindow = new google.maps.InfoWindow(), marker, i;

	// 	google.maps.event.addListener(infoWindow, 'domready', function() {
	// 		 var l = $('#info_content').parent().parent().parent().parent();
	// 		 for (var i = 0; i < l.length; i++) {
	// 			 if($(l[i]).css('z-index') == 'auto') {
	// 				 $(l[i]).css('text-align', 'center');
	// 				 $(l[i]).css('font-size', '17px');
	// 				 $(l[i]).css('cursor', 'pointer');
	// 			 }
	// 		 }
	// 	 });

	// var infoWindow = new google.maps.InfoWindow(), marker, i;

	//
	// Add the markers and infowindows to the map
	// Source: http://stackoverflow.com/questions/21514388/google-maps-api-open-multiple-info-windows-by-default
	// ------------------------------------------

	// for (var i = 0; i < markers.length; i++) {
	// 	var marker = new google.maps.Marker({
	// 		position: new google.maps.LatLng(markers[i][1], markers[i][2]), // Lat - Lon
	// 		map: map
	// 	});

	// 	var icon = 'M1.7317647058823529';

	// 	marker.setIcon({
	// 	  anchor: new google.maps.Point(0.85, 0.85),
	// 	  path: icon
	// 	});

	// 	var infowindow = new google.maps.InfoWindow({
	// 	  content: markers[i][0], // Name
	// 	  maxWidth: 160
	// 	});
	// 	infowindow.open(map, marker);
	// }


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