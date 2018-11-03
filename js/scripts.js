(function ( $ ) {

/*
	jQuery.validator.addMethod("postcodeUK", function(value, element) {
	return this.optional(element) || /^([A-Z][A-Z0-9]?[A-Z0-9]?[A-Z0-9]? {1,2}[0-9][A-Z0-9]{2})$/i.test(value);
	}, "Please specify a valid Postcode");
	
	$('#geocode').validate();
	
	alert('foo');
*/

// Copyright 2014-2015 Twitter, Inc.
// Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
  var msViewportStyle = document.createElement('style')
  msViewportStyle.appendChild(
    document.createTextNode(
      '@-ms-viewport{width:auto!important}'
    )
  )
  document.querySelector('head').appendChild(msViewportStyle)
}

    //caches a jQuery object containing the header element
    var header = $(".navbar.navbar-default");
    $(document).scroll(function() {
        var scroll = $(document).scrollTop();

        if (scroll >= 140) {
            header.addClass("navbar-fixed-top");
        } else {
            header.removeClass("navbar-fixed-top");
        }
    });




	
	$('#ninja_forms_form_6_mp_nav_wrap').hide();
    $('#ninja_forms_form_6 input').change(function(e) {
        if ($('#ninja_forms_field_182').val() && $('#ninja_forms_field_183').val() && $('#ninja_forms_field_184').val() && $('#ninja_forms_field_185').val() && $('#ninja_forms_field_186').val() && $('#ninja_forms_field_188').val()) {
            $('#ninja_forms_form_6_mp_nav_wrap').show();
        }
    });

	// currently only applied on the fuel search needs to be refactored
	var $submit = $(".submit input");
	function requiredField(){
		$submit.attr("disabled","disabled");
	}
	
	function fieldFilledin(){
		$submit.removeAttr("disabled");
	}
	 
	$("input").keyup(function(){
		fieldFilledin();
	});
	
 	requiredField();
	// EO currently only applied on the fuel search needs to be refactored


	$("#menu-main-menu-1 .sub-menu").hide();
	//$(".current-menu-item .sub-menu, .current-menu-ancestor .sub-menu").show();
 
	$('nav li li').has('ul').addClass('has-child').children('a').removeAttr('data-toggle');
	
	jQuery.fn.exists = function(){
		return this.length > 0;
	}
	
	if($('#tabs-1').exists()){
		$('#tabs-1').tabs();
	}
	
/*
	if ($('.visual').exists()) {
		$('.visual').flexslider({
			animation: "slide",
			selector: '.slideshow > li',
			slideshowSpeed: 5000,
			animationSpeed: 500,
			directionNav: false
		});
	}
*/
	// setup for accordion
/*
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false,
		autoHeight: false,
		navigation: true
	});
*/
	
	// setup colorbox
	$(".inline").colorbox({inline:true, width:"50%", opacity:"0.1"});
	$(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
	
	if ($('.slideshow').exists()) {
		var $left = $('.slideshow li.left-slide'),
			$right = $('.slideshow li.right-slide');
		$('#visual-hover-right').mouseenter(function(){
			$left.animate({
				width:0
			}, 500, function(){
				
			});
			$right.animate({
				width:940
			}, 500, function(){
				
			});
		}).mouseleave(function(){
			$left.stop(true,false).animate({
				width:469
			}, 500, function(){

			});
			$right.stop(true,false).animate({
				width:469
			}, 500, function(){

			});
		});
		$('#visual-hover-left').mouseenter(function(){
			$right.animate({
				width:0
			}, 500, function(){
				
			});
			$left.animate({
				width:940
			}, 500, function(){
				
			});
		}).mouseleave(function(){
			$right.stop(true,false).animate({
				width:469
			}, 500, function(){

			});
			$left.stop(true,false).animate({
				width:469
			}, 500, function(){

			});
		});
	}
	
/*
	$('#advertising').cycle({
    speed:   1200, 
    timeout: 24000, 
    pause:   1,
	});
*/
	
/*
    var $sidebar   = $("#advertising"), 
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });
*/
    
	$( ".tabedsearch" ).tabs({ active: 1 });
	// getter
	var active = $( ".tabedsearch" ).tabs( "option", "active" );
	 
	// setter
	$( ".tabedsearch" ).tabs( "option", "active", 1 );
	
/*
	$('.slideshow').cycle({
	    fx:     'fade', 
		slides: 'li',
	    speed: 600,
	    timeout: 8000,
	    manualSpeed: 100,
    	pagerEventBubble: true,
    	random: true
	});
*/
	
	var form = document.getElementById("searchform");
	$('#submitsearch').on('click', function(){
		form.submit();
	});
	
// 	$( document ).tooltip();
	

	

}(jQuery));