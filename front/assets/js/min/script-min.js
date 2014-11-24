(function(){var e;e=window.jQuery||window.Zepto||window.$,e.fn.fancySelect=function(s){var o,n;return null==s&&(s={}),n=e.extend({forceiOS:!1,includeBlank:!1,optionTemplate:function(e){return e.text()},triggerTemplate:function(e){return e.text()}},s),o=!!navigator.userAgent.match(/iP(hone|od|ad)/i),this.each(function(){var s,t,r,i,a,l,d;return i=e(this),i.hasClass("fancified")||"SELECT"!==i[0].tagName?void 0:(i.addClass("fancified"),i.css({width:1,height:1,display:"block",position:"absolute",top:0,left:0,opacity:0}),i.wrap('<div class="fancy-select">'),d=i.parent(),i.data("class")&&d.addClass(i.data("class")),d.append('<div class="trigger">'),(!o||n.forceiOS)&&d.append('<ul class="options">'),a=d.find(".trigger"),r=d.find(".options"),t=i.prop("disabled"),t&&d.addClass("disabled"),l=function(){var e;return e=n.triggerTemplate(i.find(":selected")),a.html(e)},i.on("blur.fs",function(){return a.hasClass("open")?setTimeout(function(){return a.trigger("close.fs")},120):void 0}),a.on("close.fs",function(){return a.removeClass("open"),r.removeClass("open")}),a.on("click.fs",function(){var s,l;if(!t)if(a.toggleClass("open"),o&&!n.forceiOS){if(a.hasClass("open"))return i.focus()}else if(a.hasClass("open")&&(l=a.parent(),s=l.offsetParent(),l.offset().top+l.outerHeight()+r.outerHeight()+20>e(window).height()+e(window).scrollTop()?r.addClass("overflowing"):r.removeClass("overflowing")),r.toggleClass("open"),!o)return i.focus()}),i.on("enable",function(){return i.prop("disabled",!1),d.removeClass("disabled"),t=!1,s()}),i.on("disable",function(){return i.prop("disabled",!0),d.addClass("disabled"),t=!0}),i.on("change.fs",function(e){return e.originalEvent&&e.originalEvent.isTrusted?e.stopPropagation():l()}),i.on("keydown",function(e){var s,o,n;if(n=e.which,s=r.find(".hover"),s.removeClass("hover"),r.hasClass("open")){if(38===n?(e.preventDefault(),s.length&&s.index()>0?s.prev().addClass("hover"):r.find("li:last-child").addClass("hover")):40===n?(e.preventDefault(),s.length&&s.index()<r.find("li").length-1?s.next().addClass("hover"):r.find("li:first-child").addClass("hover")):27===n?(e.preventDefault(),a.trigger("click.fs")):13===n||32===n?(e.preventDefault(),s.trigger("click.fs")):9===n&&a.hasClass("open")&&a.trigger("close.fs"),o=r.find(".hover"),o.length)return r.scrollTop(0),r.scrollTop(o.position().top-12)}else if(13===n||32===n||38===n||40===n)return e.preventDefault(),a.trigger("click.fs")}),r.on("click.fs","li",function(s){var n;return n=e(this),i.val(n.data("raw-value")),o||i.trigger("blur.fs").trigger("focus.fs"),r.find(".selected").removeClass("selected"),n.addClass("selected"),a.addClass("selected"),i.val(n.data("raw-value")).trigger("change.fs").trigger("blur.fs").trigger("focus.fs")}),r.on("mouseenter.fs","li",function(){var s,o;return o=e(this),s=r.find(".hover"),s.removeClass("hover"),o.addClass("hover")}),r.on("mouseleave.fs","li",function(){return r.find(".hover").removeClass("hover")}),s=function(){var s;return l(),!o||n.forceiOS?(s=i.find("option"),i.find("option").each(function(s,o){var t;return o=e(o),o.prop("disabled")||!o.val()&&!n.includeBlank?void 0:(t=n.optionTemplate(o),r.append(o.prop("selected")?'<li data-raw-value="'+o.val()+'" class="selected">'+t+"</li>":'<li data-raw-value="'+o.val()+'">'+t+"</li>"))})):void 0},i.on("update.fs",function(){return d.find(".options").empty(),s()}),s())})}}).call(this),jQuery(document).ready(function($){console.log("========================"),console.log("Document ready");var e=$(window),s=$(document).scrollTop(),o=$("body");$(".custom-select").fancySelect();var n=$("#map-sidebar-slider");n.unslider({speed:500,delay:4e3,keys:!0,dots:!0}),function(){var e=$("#search-trigger"),s=$("#search-bar"),o=$("#navigation"),n=$("#content"),t=$("#search-field");e.click(function(){console.log("========================"),console.log("Search trigger clicked"),e.toggleClass("triggered"),o.add(n).toggleClass("make-room"),s.toggleClass("visible"),s.hasClass("visible")?t.focus():t.blur()})}();var t=$(".overview__slide").length,r=$(".overview__slide-container"),i=$(".overview__slide"),a,l=0;console.log(t,"slides"),$(".overview__controls .next").click(function(s){s.preventDefault();var o,n,i=l+1,a=l+2;switch(e.width()<480?(o=100,n="one"):e.width()<=1024?(o=50,n="two"):(o=33.33,n="three"),n){case"one":i==t?l=0:l++;break;case"two":i==t-1?l=0:l++;break;case"three":i==t-2?l=0:l++}console.log("$target_slide_index is",i),r.css({marginLeft:l*-o+"%"})})});