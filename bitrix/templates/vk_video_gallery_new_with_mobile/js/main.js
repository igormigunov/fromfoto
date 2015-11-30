$(document).ready(function(){
	$(document).on("click", '.tab-item-img img', function(){
		var _this = $(this);
		var _section_id = _this.closest(".tab-item-img").attr("_section_id");
		$.post("/ajax/ret_video.php", {_id : _this.closest(".tab-item-img").attr("_id")	}, function(data){
			var _delim = (_section_id == '186') ? 1 : (9 / 16);
			$(_this.closest(".tab-item-img")).css('height', (parseInt($(_this.closest(".tab-item-img")).width()) * _delim) + 'px');
			_this.closest(".tab-item-img").html(data);
			console.log(parseInt($('iframe', _this.closest(".tab-item-img")).width()));
		});
	});
	
	$( window ).resize(function() {
		resize_iframe();
	});
	resize_iframe();
	function resize_iframe(){
		$('.video iframe, .template-video iframe, .redactor-navigation .preview_clip_img img, .redactor-navigation .preview_clip_str').css('height', (parseInt($('.video iframe, .template-video iframe').width()) * 9 / 16) + 'px');
		$('.preview_clip_img').css('margin-top', '-' + ($('.preview_clip_img').height()/2 - 10) + 'px');
		$('.redactor-navigation .preview_clip_str').css('margin-top', '-' + ($('.redactor-navigation .preview_clip_str').height()/2 - 28) + 'px');
		$('.redactor-navigation .preview_clip_str img').css('margin-top', ($('.redactor-navigation .preview_clip_str').height()/2 - 45) + 'px');
	}
	$('.like-button').click(function(){
		$.post("/ajax/add_count.php", {add:'1'	}, function(data){
			$('input.like_values').val(data);
			$('.like-button').hide("Normal");
		});
		
	});
	$.post("/ajax/add_count.php", {	}, function(data){
		$('input.like_values').val(data);
	});

$(".vs_thumbimage").click(function(){
		$("#vs_videoback iframe").attr('src', $(this).attr('data-video'));
		$("#vs_videoback").fadeIn(0);
var vHeight = $('#vs_videowrapper').width() * 9/16;
$('#vs_videowrapper').css('height', vHeight+'px');
	});
	$("#vs_videoback").click(function(){
		$(this).fadeOut(0);
		$("#vs_videoback iframe").attr('src', '');
	});
	$("#vs_moveright").click(function(){
		var vDelta = $("#vs_panel").position().left + $("#vs_panel").width() + 88;
		if (vDelta > $("#vs_wrapper").width()){
			var vIncrease = $("#vs_wrapper").width() - vDelta;
			$("#vs_panel").animate({left: "+=" + vIncrease}, 1140);
		};
	});
	$("#vs_moveleft").click(function(){
		if ($("#vs_panel").position().left < 0){
			var vDelta = $("#vs_panel").position().left + $("#vs_panel").width() + 88;
			var vIncrease = $("#vs_wrapper").width() - vDelta;
			$("#vs_panel").animate({left: 0}, 1140);
		};
	});

  textareas = $("textarea");
  if (textareas.length > 0) {
    $("textarea").autoResize();
  }
  $(".tab").tabs({
    hide: { effect: "fade", duration: 550 }
  });
  $( ".upload-table" ).not('.not_sortable').sortable({
    appendTo: document.body
  });
  $(window).resize(function() {
    var width = calcWidth();
    var img_width = $(".jcrop-holder img").width();
    var img_height = $(".jcrop-holder img").height();
    var heightKoif = img_height/img_width;
    $(".jcrop-holder img").width(width).height(width*heightKoif);
    $(".jcrop-holder").width(width).height(width*heightKoif);
  });
  $('#countdown_dashboard').countDown({
    targetOffset: {
      'day':    1,
      'month':  1,
      'year':   0,
      'hour':   2,
      'min':    1,
      'sec':    59
    }
  });
  $('#countdown_dashboard_2').countDown({
    targetOffset: {
      'day':    0,
      'month':  0,
      'year':   0,
      'hour':   0,
      'min':    0,
      'sec':    0
    }
  });
  
})

function calcWidth() {
  var BodyWidth = $("body").width();
  var width = $(".popup-container").width();
  if (BodyWidth < 768) {
    return width * 0.9;
  }
  else {
    if (BodyWidth > 768 && BodyWidth < 1024) {
      return width * 0.85;
    }
    else 
      return width * 0.81;
  } 
}

function setcookie(name, value, expires, path, domain, secure) {
	expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date(+(new Date) + expires * 1e3)).toGMTString());
	var r = [name + "=" + escape(value)], s, i;
	for(i in s = {expires: expires, path: path, domain: domain}){
		s[i] && r.push(i + "=" + s[i]);
	}
	return secure && r.push("secure"), document.cookie = r.join(";"), true;
}
				
function getCookie(name) {
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	))
	return matches ? decodeURIComponent(matches[1]) : undefined
}