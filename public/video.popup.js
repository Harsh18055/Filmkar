!function(o){o.fn.videoPopup=function(e){var t={embedLink:""},n=o.extend({autoplay:!1,showControls:!0,controlsColor:null,loopVideo:!1,showVideoInformations:!0,width:null,customOptions:{}},e),i={youtube:{regex:/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,test:function(o,e){var t=o.match(e);return!(!t||11!=t[7].length)&&t[7]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,showinfo:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://www.youtube.com/embed/"+e+"/?"+o.param(t)}},vimeo:{regex:/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/,test:function(o,e){var t=o.match(e);return!(!t||!t[5].length)&&t[5]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,title:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://player.vimeo.com/video/"+e+"/?"+o.param(t)}}};return o(this).css("cursor","pointer"),o(this).on("click",(function(e){e.preventDefault();var s;!function(e){o.each(i,(function(o,n){var i=n.test(e,n.regex);if(i)return t.embedLink=n.mount(i),this}))}(o(this).attr("data-video-url"));o(".open1").append((s='<iframe src="'+t.embedLink+'" allowfullscreen frameborder="0" width="'+n.width+'"></iframe>',t.embedLink||(s='<div class="videopopupjs__block--notfound">Video not found</div>'),'<div class="videopopupjs videopopupjs--animation"><div class="videopopupjs__content"><span class="videopopupjs__close"></span>'+s+"</div></div>")),o(".videopopupjs, .videopopupjs__close").click((function(){o(".videopopupjs").addClass("videopopupjs--hide").delay(515).queue((function(){o(this).remove()}))}))})),o(document).keyup((function(e){27==e.keyCode&&o(".videopopupjs__close").click()})),this},o.fn.videoPopup2=function(e){var t={embedLink:""},n=o.extend({autoplay:!1,showControls:!0,controlsColor:null,loopVideo:!1,showVideoInformations:!0,width:null,customOptions:{}},e),i={youtube:{regex:/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,test:function(o,e){var t=o.match(e);return!(!t||11!=t[7].length)&&t[7]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,showinfo:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://www.youtube.com/embed/"+e+"/?"+o.param(t)}},vimeo:{regex:/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/,test:function(o,e){var t=o.match(e);return!(!t||!t[5].length)&&t[5]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,title:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://player.vimeo.com/video/"+e+"/?"+o.param(t)}}};return o(this).css("cursor","pointer"),o(this).on("click",(function(e){e.preventDefault();var s;!function(e){o.each(i,(function(o,n){var i=n.test(e,n.regex);if(i)return t.embedLink=n.mount(i),this}))}(o(this).attr("data-video-url"));o("#openbi").append((s='<iframe src="'+t.embedLink+'" allowfullscreen frameborder="0" width="'+n.width+'"></iframe>',t.embedLink||(s='<div class="videopopupjs__block--notfound">Video not found</div>'),'<div class="videopopupjs videopopupjs--animation"><div class="videopopupjs__content"><span class="videopopupjs__close"></span>'+s+"</div></div>")),o(".videopopupjs, .videopopupjs__close").click((function(){o(".videopopupjs").addClass("videopopupjs--hide").delay(515).queue((function(){o(this).remove()}))}))})),o(document).keyup((function(e){27==e.keyCode&&o(".videopopupjs__close").click()})),this},function(o){o.fn.videoPopup3=function(e){var t={embedLink:""},n=o.extend({autoplay:!1,showControls:!0,controlsColor:null,loopVideo:!1,showVideoInformations:!0,width:null,customOptions:{}},e),i={youtube:{regex:/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,test:function(o,e){var t=o.match(e);return!(!t||11!=t[7].length)&&t[7]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,showinfo:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://www.youtube.com/embed/"+e+"/?"+o.param(t)}},vimeo:{regex:/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/,test:function(o,e){var t=o.match(e);return!(!t||!t[5].length)&&t[5]},mount:function(e){var t={autoplay:n.autoplay,color:n.controlsColor,loop:n.loopVideo,controls:n.showControls,title:n.showVideoInformations};return Object.assign(t,n.customOptions),"https://player.vimeo.com/video/"+e+"/?"+o.param(t)}}};return o(this).css("cursor","pointer"),o(this).on("click",(function(e){e.preventDefault();var s;!function(e){o.each(i,(function(o,n){var i=n.test(e,n.regex);if(i)return t.embedLink=n.mount(i),this}))}(o(this).attr("data-video-url"));o("body").append((s='<iframe src="'+t.embedLink+'" allowfullscreen frameborder="0" width="'+n.width+'"></iframe>',t.embedLink||(s='<div class="videopopupjs__block--notfound">Video not found</div>'),'<div class="videopopupjs1 videopopupjs--animation"><div class="videopopupjs__content"><span class="videopopupjs__close"></span>'+s+"</div></div>")),o(".videopopupjs__content").css("max-width",1024),n.width&&o(".videopopupjs__content").css("max-width",n.width),o(".videopopupjs1").hasClass("videopopupjs--animation")&&setTimeout((function(){o(".videopopupjs1").removeClass("videopopupjs--animation")}),200),o(".videopopupjs1, .videopopupjs__close").click((function(){o(".videopopupjs1").addClass("videopopupjs--hide").delay(515).queue((function(){o(this).remove()}))}))})),o(document).keyup((function(e){27==e.keyCode&&o(".videopopupjs__close").click()})),this}}(jQuery)}(jQuery);