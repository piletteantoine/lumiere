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
// Map: draggable slider
// ------------------------------------------------------------

// var dragger = new Dragdealer('demo-simple-slider', {
//  right: 35,
//  left: -5,
//  callback: function(x, y) {
//    console.log(x);
//  }
// });


// ------------------------------------------------------------
// Map: Image slider
// ------------------------------------------------------------

var $map_sidebar_slider = $('#map-sidebar-slider');

$map_sidebar_slider.unslider(
{
  speed   : 500,
  delay   : 4000,
  keys    : true,
  dots    : true,

});


// ------------------------------------------------------------
// Main navigation: search bar
// ------------------------------------------------------------

(function() {

  var $search_trigger = $('#search-trigger'),
    $search_bar   = $('#search-bar'),
    $main_nav   = $('#navigation'),
    $content    = $('#content'),
    $search_field = $('#search-field');

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
var count         = $(".overview__slide").length,
  $slides_container   = $(".overview__slide-container"),
  $slides       = $(".overview__slide"),
  n_interval_id,
  $slide_index    = 0;

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