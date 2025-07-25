/*!

	Marena - One Page Vertical / Horizontal Template
	Copyright (c) 2014, Subramanian 

	Author: Subramanian
	Profile: themeforest.net/user/FMedia/
	
	Version: 1.0.0
	Release Date: July 2014
	
*/	


"use strict";
		
/* Define required varaible */
	var isMobile = screen.width <= 767;
	var mobileDevice = screen.width < 1024 && screen.height < 1024;
	var isSmartPhone = ((screen.width <= 959) || (screen.height <= 959));
	var ipad = (screen.width === 768 || screen.height === 768) && (screen.width === 1024 || screen.height === 1024) ;
	var lowResDesktop = window.innerWidth <= 979;
	var isMobileChk = screen.width < 768;
	var isTouch = false;
	var siteStartOpen = false;
	var scrollPos = 0;
	var flxDelay = 5000;
	var headerClose = false;
	var pageHeaderHeight = 90;
	var pageHeaderHeight_mini = 55;
	var defaultVolume = 0;
	var apiRS;
	var supersizedOnBody = true;
	
	
	var isTouch = false;
	var swipeThreshold = 75;
	var siteStartOpen = false;
	var scrollPos = 0;
	var flxDelay = 5000;
	var fmUrl = undefined;
	var currentPage_menu = "home";
	var leftMenu = true;
	var pageAlignCenter =  false;
	var scrollHorizontal =  false;
	var onePageVersion =  false;
	var browserWebkit;	
	/* set top Menu height - to fix the browser bug */
	var topMenuHeight = 60;
	/* Enable/disable Menuauto Hide */
	var menuAutoHide = true;
	/* preload images are defined here */	
	var preLoadImgs = [];
	
	var cssAnimate = true;
	
	var animateSyntax = "transition";
	
	
	var BigVid;
	var bgVideopath = "videos/video.mp4";
	
	
	/* set the Final date in YYYY/MM/DD HH:SEC:MIN formate  */
	var countdown_value = '2014/10/18 00:00:00 ';
	var countdown_finish = 'countdown finished';
	
	
	var agent;
	var ipadDevice;
	var iPhoneDevice;
	var iVersion;
	var retinaDevice;	

	var fancy_bgCol = "#fff";
	var fancy_bgCol_alpha = 1;
	
	var aniInEff = "animated fast fadeInRight";
	var aniOutEff = "animated fast fadeOutLeft";
	

	$(document).ready(function(){

		cssAnimate = Modernizr.webgl ? true : false;
		animateSyntax = cssAnimate ? "transition" : "animate";
		
		/* Find touch device */		
		if (window.navigator.msMaxTouchPoints) {
			isTouch = Boolean(window.navigator.msMaxTouchPoints>1);			
		} else if (window.navigator.maxTouchPoints && window.navigator.pointerEnabled) {
			isTouch = Boolean(window.navigator.maxTouchPoints);			
		} else {
			isTouch = Modernizr.touch;
		}
		
		retinaDevice = window.devicePixelRatio !== undefined &&  window.devicePixelRatio > 1 ? true : false;
		
		if(retinaDevice){
			$("body").addClass("retinaDevice");
		}
		
		if(!isTouch){
			$("body").addClass("notTouchDevice");
		}
		
		pageHeaderHeight = $("body").hasClass("horizontal_layout") || $(".header").hasClass("menuType1") ? 90 : 55;
		
		
		// Find ipad device
		agent = (window.navigator.userAgent).toLowerCase();
		ipadDevice = agent.indexOf("ipad") > -1;
		iPhoneDevice = agent.indexOf("iphone") > -1;
		iVersion = agent.slice(agent.indexOf("version/")+8,agent.indexOf("version/")+11);
		
		fancy_bgCol = $('body').hasClass("white_ver") ? "#fff" : "#111";
		fancy_bgCol_alpha = .98;
		
		var iimg = !retinaDevice ? "images/supersized/pause.png" : "images/supersized/pause@2x.png";
		$("#pauseplay").attr("src",iimg);
		
		$(".addFxEmbossBtn li a").addClass("fxEmbossBtn");
		$(".addFxEmbossBtn li a").append('<span class="btn_hover"></span> ');

		
		
		if( ! ($.browser.msie && ($.browser.version <= 11)) && !isTouch ) {
			$("body").addClass("addCssTransition");
		}
		
		if( (($.browser.version < 10))) {
			$("body").addClass("itsBadIE");
		}
		
		
/* Fit Text plugin Initialization */	
		try { $(".fittext1").fitText(); } catch (e) { }
		try { $(".fittext2").fitText(1.2, { minFontSize: '12px', maxFontSize: '70px' }); } catch (e) { }
		try { $(".fittext3").fitText(1.1, { minFontSize: '12px', maxFontSize: '40px' }); } catch (e) { }
		
		
	// FitVids Initialization
		try {  $(".container").fitVids(); } catch (e) { }
		try {  $(".container-fluid").fitVids(); } catch (e) { }	

// Header menuType1 Animation	
	
		if( $(".header").hasClass("menuType1") ){
			var mp = Math.round( Math.abs(100/$(".header_content>ul").children().length))+.90;
			$(".header_content>ul>li").css({"min-width": mp-1+"%"});
		}
	
	
// Mobile Menu
	
		$(".mobile_menu_btn").bind("click", function(event) {
			if($(".header_content").css("display") === "block"){
				$(".header_content").data("open", false);				
				$(".header").removeClass("menuOpen");
			}else{
				$(".header_content").data("open", true);				
				$(".header").addClass("menuOpen");
				
			}
			setTimeout( function(){ if(!isTouch){ $("html").getNiceScroll().resize(); }	 }, 500);
		});
	

// magnificPopup plugin Initialization 

		//Initialize Image
		$('.magnificPopup').each(function(){
			var mc = $(this);
			var tit = mc.attr("data-title") !== undefined ? "data-title" : "title";
			var typ = mc.attr("data-type") !== undefined ? mc.attr("data-type") : "image";
			mc.magnificPopup({
			  image: { titleSrc : tit },
			  type: typ,
			  removalDelay: 500, //delay removal by X to allow out-animation
			  callbacks: {
				change: function() {
					this.content.addClass("animated fadeInLeft");
				  },
			  },
			  closeOnContentClick: true,
			  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
			 });
		 });	
		  
		 
		 //Initialize Gallery
		 $('.magnificPopup_gallery').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
				  enabled:true
				},
				callbacks: {
				change: function() {
					this.content.addClass("animated fadeInLeft");
				  },
				},
				closeOnContentClick: true,
				midClick: true, // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
			});
		}); 	
			 
		 
		 // Initialize portfolio item gallery
		 $('.magnificPopup_item_gallery').each(function(){
			 var mc = $(this);
			var  p_items = [];
			 mc.find(".i_gallery").children().each(function(){
				var mc2 = $(this);
				var tit = mc2.attr("data-title") !== undefined ? mc2.attr("data-title") : mc2.attr("title");
				p_items.push({ src : mc2.attr("data-href") , title : tit, type : mc2.attr("data-type") });
			});			
		 	mc.magnificPopup({	
				items:  p_items, // the selector for gallery item
				type: 'image', // this is default type
			  	removalDelay: 500, //delay removal by X to allow out-animation
				gallery: {
				  enabled:true
				},
			  	callbacks: {
				change: function() {
					this.content.addClass("animated fadeInLeft");
				  },
			  	},
			  	closeOnContentClick: true,
			 	midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
			});
		});
		
		// Initialize inline content
		$('.magnificPopup_inline').magnificPopup({
		  type:'inline',
		  callbacks: {
		  change: function() {
			  this.content.addClass("animated fadeInLeft");
			},
		  },
		  closeOnContentClick: true,
		  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
		});

	
		// Initialize popup detail text	
		$('.detail_text').each(function(){	
			var cont = $(this).find(".popup_text")
			$(this).find(".link_btn").magnificPopup({
			  items: {
				  src: cont,
				  type: 'inline'
			  },
			  removalDelay: 500, //delay removal by X to allow out-animation				  
			  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
			});
		});
		
		
// Initialize Background video show Hide button code
		
		$(".bgVideoBtn").each(function(){
			var on_ = $(this).find(".videoUnMute");
			var off_ = $(this).find(".videoMute");
			
			on_.bind("click", function(event) {
				off_.show();
				on_.hide();
			});
			
			off_.bind("click", function(event) {
				off_.hide();
				on_.show();
			});
			
		});
		
		
// Load Big Video for desktop 
		
			// if(Modernizr.video){
						
			// 	$(function() {
			// 		BigVid = new $.BigVideo();
			// 		BigVid.init();					
			// 	});				

			// 	$(".vidPlyPauBtn").data("view", true);
				
			// 	$(".vidPlyPauBtn").click(function() {
			// 		$(this).find("i").attr("class", "");					
			// 		if($("#big-video-vid").css("display") !== "none"){
			// 			BigVid.getPlayer().pause();
			// 			$(this).find("i").addClass("fa fa-eye");
			// 			$("#big-video-vid").css({"display":"none"});
			// 		}else{
			// 			BigVid.getPlayer().play();
			// 			$(this).find("i").addClass("fa fa-eye-slash");
			// 			$("#big-video-vid").css({"display":"block"});
			// 		}
			// 	});
				
			// 	$("#big-video-wrap").css({"display":"none"});
			// }
			
		
			
			
/* Flicker feed */

		try {  
		   $('.flickerFeed').each(function(){
			   var numItem = $(this).attr("data-numPost") ? Number($(this).attr("data-numPost")) : 6;
				$(this).jflickrfeed({
				limit: numItem,
				qstrings: {
					id: '52617155@N08'
				},
				itemTemplate:
				'<li>' +
					'<a class="flickerPop" href="{{image}}" title="{{title}}">' +
						'<img src="{{image_s}}" alt="{{title}}" />' +
					'</a>' +
				'</li>'
			  }, function(data) {			  
				 /* $('.flickerPop').magnificPopup({
						mainClass: 'mfp-with-zoom',
						removalDelay: 300,
						type: 'image' // this is default type
					});	*/		
			  });
		  });
		  
		  
		   $('.flickerFeed').each(function(){
				$(this).magnificPopup({
				  delegate: 'a', // child items selector, by clicking on it popup will open
				  type: 'image',
				  gallery:{
					enabled:true
				  },
				  removalDelay: 500, //delay removal by X to allow out-animation
				  callbacks: {
					change: function() {
						this.content.addClass("animated fadeInLeft");
					  },
				  },
				  closeOnContentClick: true,
				  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
				});
		  	});
			
		} catch (e) { }		  
		  

// Hexagon mask fix
  		if(!Modernizr.cssmask){
			$(".hexagon").addClass('circular');
		}
	
		try {
		
			/* Contact page close button*/	
			$(".closeBtn").click(function(){
				var sel =	$($(this).attr("data-content"));
				if( parseInt(sel.css("top")) < sel.height()-70){
					sel[animateSyntax]({"top":sel.height()-50},500, "easeInOutQuart");
					$(this).children(":first-child").children(":first-child").css({"right" : "0px"});
				}else{
					sel[animateSyntax]({"top":"0px"},500, "easeInOutQuart");
					$(this).children(":first-child").children(":first-child").css({"right" : "-40px"});
				}
			});
			
			
			/* Add background if it placed below the parallax */
			$("body").find(".inverseStyle.parallax").each(function(){
				$(this).prepend('<div class="inverseStyle" style="position:absolute; width:100%; height:100%; top:0px; left:0px">  </div>')
			});
			
			
			$("body").find(".contentWrapper.lightStyle.parallax").each(function(){
				$(this).prepend('<div class="lightStyle" style="position:absolute; width:100%; height:100%; top:0px; left:0px">  </div>')
			});
			
		} catch (e) { }

		

// Initilize Tab
		
		$('body').find('ul.tabs > li > a').each( function(){
			 $($(this).attr('href')).data("vidd",  $($(this).attr('href')).find('.tabVideo .addVideo') );
		});
		
		$('body').on('click', 'ul.tabs > li > a', function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr('href');
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				$(this).parent().siblings().children('a').removeClass('active');
				$(this).addClass('active');
			
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				$(contentLocation).css({"opacity":"0"})[animateSyntax]({"opacity":1},900);
				
				$('body').find('ul.tabs > li > a').each( function(){
					$($(this).attr('href')).find('.tabVideo .addVideo').remove();
				});

				$(contentLocation).find('.tabVideo').append($(contentLocation).data("vidd"))
				
				$("body").mainFm('scroll_update');
					
				$(contentLocation).find('.graph_container').each(function() {
					$("body").mainFm('graph_display',$(this));
				});
			}
		});


		
// Initilize tipsy 

		$('.hastip').tipsy({gravity: 's'});		
		$('.dotted-nav li a').tipsy({gravity: 'e'});
		$('.dotted-nav li a').click(function(){
			$(".tipsy").hide();
			});


	
// Initilize Graph
		
		$("body").find('.contentWrapper').each(function(){
			$(this).find('.graph_container').each(function(){
				$(this).find('li').each(function() {
					var selK = $(this).find(".display");
					$(this).each(function() {
						var vall = parseInt($(this).attr('data-level')) >= 100 ? "101%" : $(this).attr('data-level');
						$(this).children(':first-child').css("width",vall);						
						selK.text(  parseInt($(this).attr('data-level')));
					});
				});
			});

		});
		
		
// Accordion
		
		jQuery(function($){
				 
			$('.accordion').each( function(){
				
				var allDt = $(this);
				var allPanels = allDt.find(' > dd').hide();
				allDt.find(' dt a').removeClass("active");
				 
				if($(this).attr("data-openFirstElement") === "true"){
				  $(this).children(":first-child").find("a").data('show',true);
				  $(this).children(":first-child").find("a").addClass("active");
				  var $target =  $(this).children(":first-child").next();
				  $target.addClass('active').slideDown();
				}
				
				
				$(this).find(' > dt > a').click(function() {
					var $this = $(this);
					var $target =  $this.parent().next();
					
					$("body").mainFm('intVideoObject', $this);				
					$("body").find('.tabVideo').each(function(){
						$(this).find('.vid').remove();
						$(this).find('img').show();
						$(this).find('.video_hover').show().css({"z-index":"5"});
					});
					
					$target.find("a.lazyload").each(function(){
						$("body").mainFm('lazyLoadInt', $(this));
					});
					
					$target.find("a.lazyload_single").each(function(){
						$("body").mainFm('lazyLoadInt', $(this));
					});
					
					$target.find("a.lazyload_fluid").each(function(){
						$("body").mainFm('lazyLoadInt', $(this));
					});
										
					
					$("body").mainFm('intVideoObject', $this);
									
					$("body").find('.tabVideo').each(function(){
						$(this).find('.vid').remove();
						$(this).find('img').show();
						$(this).find('.video_hover').show().css({"z-index":"5"});
					});
					
					
					if($(this).parent().parent().attr("data-autoHide") !== "false"){
						if($this.hasClass("active")){
							allDt.find(' dt a').removeClass("active");
							allPanels.removeClass('active').slideUp();
						}else{
						allDt.find(' dt a').removeClass("active");
						$this.addClass("active");
						$target =  $this.parent().next();
						if(!$target.hasClass('active')){
							allPanels.removeClass('active').slideUp();
							$target.addClass('active').slideDown();
						}
						
						}
					}else{	
						
						if($this.data('show')){
							$this.data('show',false);
							$this.removeClass("active");
							$target.removeClass('active').slideUp();
						}else{
							$this.data('show',true);
							$this.addClass("active");
							$target.addClass('active').slideDown();							
						}
						
					}
					
					setTimeout(function(){ $("body").mainFm('scroll_update'); },500);
					
					return false;
				});
			});
		}); 
	
		jQuery(function($){
		  var allPanels = $('.accordion_autoHide > dd').hide();
		  $('.accordion_autoHide > dt > a').prepend('<span class="closeOpen" ></span>');
		  $('.accordion_autoHide > dt > a').click(function() {
			$('.accordion_autoHide dt a').removeClass("active");
			var $this = $(this);
			$this.addClass("active");
			$target =  $this.parent().next();
			if(!$target.hasClass('active')){
			  allPanels.removeClass('active').slideUp();
			  $target.addClass('active').slideDown();
			}

			setTimeout(function(){ $("body").mainFm('scroll_update'); },500);
			return false;
		  });
		});
	

		
	
	});






		

/* Initilize vimeo player */



function vimeo_video(mc){
	(function(){
	  // Listen for the ready event for any vimeo video players on the page
	  var  player = document.querySelector(mc);
	   $f(player).addEvent('ready', ready);
	  

	  function addEvent(element, eventName, callback) {
		  if (element.addEventListener) {
			  element.addEventListener(eventName, callback, false);
		  }
		  else {
			  element.attachEvent('on' + eventName, callback);
		  }
	  }

	  function ready(player_id) {
		  // Keep a reference to Froogaloop for this player
		  var container = document.getElementById(player_id).parentNode.parentNode,
			  froogaloop = $f(player_id);
		  
		  //buttons = container.querySelector('div dl.simple'),
			  var volumeBtn = container.querySelector('.volume');
			  
			   froogaloop.api('setVolume', 0);
			   
			  // Call setVolume when volume button clicked
			  addEvent(volumeBtn, 'click', function(e) {
				  // Don't do anything if clicking on anything but the button (such as the input field)
				  if (e.target != this) {
					  return false;
				  }

				  // Grab the value in the input field
				  var volumeVal = this.querySelector('input').value;

				  // Call the api via froogaloop
				  froogaloop.api('setVolume', volumeVal);
			  }, false);

			  // Call setLoop when loop button clicked 
	  }
  })();
}


	
	
			
/* cycle slideshow plugin  initilize */

function cycle_pluign(mc){
	var aniType = mc.attr("data-transition") ? mc.attr("data-transition") : 'scrollDown';
	var tim = !isNaN(mc.attr("data-starttime")) ? Number(mc.attr("data-starttime")) : 0;
	var tim_end = !isNaN(mc.attr("data-endtime")) ? Number(mc.attr("data-endtime")) : 2000;
	var easingType = mc.attr("data-easing") ? mc.attr("data-easing") : 'easeInOutBack';
	mc.hide();
	var nextBtn = mc.find(".next");
	var prevBtn = mc.find(".prev");
	mc.parent().find(".cycleNextPrev").append(nextBtn);
	mc.parent().find(".cycleNextPrev").append(prevBtn);
	setTimeout(function(){
		mc.show();
		mc.cycle({
			fx: aniType, // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			speed:    1000, 
			easing: easingType,
			containerResize: 1,
			slideResize:      1,
			timeout:  tim_end ,
			pause:   true,
			next: nextBtn,
            prev: prevBtn
		});
	}, tim)
}	



// Initilize elastislide slider, Used in fullScreen Gallery, Portfolio detail page gallery (see portfolio.html file)
	
	function carousel_gallery_int (mc){	

		mc.find(".carousel_thumbails").css({"visibility":"hidden", "opacity":0});							
		var current = 0,					
		$carouselEl = mc.find(".carousel_thumbails"),
		$preview = $( mc.attr("data-link") ),
		$carouselItems = $carouselEl.children(),
		isFullScreen = mc.hasClass("fullScreen"),
		isSmoothResize = $preview.hasClass("smooth_resize"),
		smothFirstLod = true,
		nextBtn = $preview.find('.proj_next'),
		prevBtn = $preview.find('.proj_prev'),
		fullNextBtn = mc.parent().find(".gallery_navigations a.next_button"),
		fullPrevBtn = mc.parent().find(".gallery_navigations a.previous_button"),
		fullClosBtn = mc.parent().find(".gallery_navigations a.thumbClose_btn"),
		
		carousel = $carouselEl.elastislide( {
			current : current,
			minItems : 1,
			onClick : function( el, pos, evt ) {
				changeImage( el, pos, isFullScreen);
				evt.preventDefault();
			},
			onReady : function() {
				mc.find(".carousel_thumbails").css({"visibility":"visible"}).animate({"opacity":1}, 200, "easeInOutQuart");				 
				try{
					var thu = $( mc.data("thu"));
					var sc = thu.find('.thumbClose_btn .btn_icon');
					var cc = thu;
					thu.css({"visibility":"visible"});
					/*if(!isTouch && !self.mobile){
						thu.removeClass("mobileView");
						if(thu.width()<15){
							sc.text("OPEN");
						}else{
							sc.text("CLOSE");
						}
					}else{*/
					if(self.alignPgHor && !isTouch){
						ele.mCustomScrollbar("update");
						ele.mCustomScrollbar("scrollTo","top");	
					}
						thu.addClass("mobileView");
						sc.children(":first-child").text("Thumbnails");	
						
				//	}					
					
					if(sc.data("firLod") === undefined){
						sc.data("firLod", true);
					}
					
					prevBtn.css({"opacity":.5});

					nextBtn.click(function(){ goNextSlider(); });					
					prevBtn.click(function(){ goPrevSlider(); });
					fullNextBtn.click(function(){ goNextSlider(); });
					fullPrevBtn.click(function(){ goPrevSlider(); });
					
					
					fullNextBtn.hover(function(){
						mc.data("thu").data("cHovBtn", "nx");
						if(mc.data("thu").hasClass("miniView")){
							var cur = $carouselEl.children().length-1 > $carouselEl.data("cur") ? $carouselEl.data("cur")+1 : 0;
							carousel._slideToItem(cur);
						}
					});
					
					fullPrevBtn.hover(function(){
						mc.data("thu").data("cHovBtn", "pr");
						if(mc.data("thu").hasClass("miniView")){
							var cur = $carouselEl.data("cur") > 0 ? $carouselEl.data("cur")-1 : $carouselEl.children().length-1;
							carousel._slideToItem(cur);
						}
					},function(){
						mc.data("thu").data("cHovBtn", "nx");	
						});
						
					fullClosBtn.click(function(){						
						if(!mc.data("thu").hasClass("miniView")){
							var ccc = $carouselEl.data("cur");
							if($carouselEl.data("cur") < 3 || $carouselEl.data("cur") > $carouselEl.children().length-5){
								ccc = $carouselEl.data("cur") < 3 ? 3 : $carouselEl.children().length-5;
							}
							carousel._slideTo(ccc);
						}
					});
					
					
				} catch(e){ }
					
					if($preview !== undefined){
						try{		  
						$(function() {	
							$preview.swipe( {
								//Generic swipe handler for all directions
								swipe:function(event, direction, distance, duration, fingerCount) {
									if(direction === "left"){
										goNextSlider();
									}
									if(direction === "right"){
										goPrevSlider();
									}
									
								},
								allowPageScroll : "vertical",
								//Default is 75px, set to 0 for demo so any distance triggers swipe
								threshold:swipeThreshold
							});
						});
						
					  }catch(e){}
					}
					
					mc.data("thu").data("cHovBtn", "nx");
					changeImage( $carouselItems.eq( current ), current, isFullScreen );
				} 
					                 
			});
		
		var interval;
		
		function goNextSlider(){
			
			if($carouselItems.length-1 > current){							
				  current = current+1;	
			}else{
				 current = 0;
			}
									
			$carouselItems.removeClass( 'current-img' );
			$carouselItems.eq( current ).addClass( 'current-img' );
			if(!$($carouselEl).parent().parent().parent().hasClass("withoutThumb")){
				carousel.setCurrent( current );			
				carousel._slideToItem(current);					
			}
			changeImage( $carouselItems.eq( current ), current, false );			
			mc.data("thu").data("cHovBtn", "nx");			  			
		}
		
		function goPrevSlider(){
			if(current > 0){							
				current = current - 1;	
			}else{
				current = $carouselItems.length-1;
			}				
			$carouselItems.removeClass( 'current-img' );
			$carouselItems.eq( current ).addClass( 'current-img' );
			if(!$($carouselEl).parent().parent().parent().hasClass("withoutThumb")){
				carousel.setCurrent( current );			
				carousel._slideToItem(current);
			}
			changeImage( $carouselItems.eq( current ), current, false );			
			mc.data("thu").data("cHovBtn", "px");
		}
			
		function changeImage( el, pos, isFullScreen ) {	
					
			if(isSmoothResize && !smothFirstLod){
				$preview.css({"height":$preview.height()+ parseInt($preview.css("padding-top"))});				
			}	
			
			$("body").mainFm('fullScreenGallery', $preview);					

			var nn = 0;		
			
			var inAnimat = $preview.attr("data-animated-in") !== undefined ? $preview.attr("data-animated-in") : aniInEff;
			var outAnimat = $preview.attr("data-animated-in") !== undefined ? $preview.attr("data-animated-out") : aniOutEff;			
					
			$preview.data("startLoaded", false);
			
			function resetImg (mc, in_, out_){
				$preview.data("startLoaded", true);							
				mc.css({"left": -$preview.width()}).hide();						  
				mc.removeClass(in_ + out_);	
			};
						 
			$preview.find(".carousel_item").each(function(){				
				if("#"+$(this).attr("id") != el.data( 'preview')){
					clearInterval(interval);
					
					if( $(this).css("display") !== "none"){
						nn++;
					 
						 var kk = -5;
						 var self = $(this);
						 var aniInTyp = aniInEff;
						 var aniOutTyp = aniOutEff;
						 
						 var mc_ = $(this);
						 var jj = 0;
						 
						$(this).find('[data-animated-out]').each(function(){
						  var mc = mc_ = $(this);
						  mc.stop();
						  jj++;
						  aniInTyp = mc.attr("data-animated-in") !== undefined ? mc.attr("data-animated-in") : aniInTyp;
						  aniOutTyp = mc.attr("data-animated-out") !== undefined ? mc.attr("data-animated-out") : aniOutTyp;
						  
						  if(cssAnimate){
						  		mc.removeClass(aniInTyp).addClass(aniOutTyp).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							  		resetImg($(this),aniInTyp, aniOutTyp );					 
								});									
						  }else{
							  mc.animate({"left":-25, "opacity":0},500, "easeInOutQuad", function(){
							  	resetImg($(this),aniInTyp, aniOutTyp );
							  });
							}
					  });
					  
					  if(jj == 0){		
					  
					  if(cssAnimate){			  				   					  
						mc_.removeClass(inAnimat).addClass(outAnimat).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							resetImg($(this),inAnimat, outAnimat );				 
						});						
					  }else{
						 mc_.animate({"left":-25, "opacity":0},500, "easeInOutQuad", function(){
							  resetImg($(this),inAnimat, outAnimat );
						  });			
						}
					  }
					}
				}				  
			});
			
			if(nn === 0){
				$preview.data("startLoaded", true);
			}
			
			interval =	setInterval(function(){

				if($preview.data("startLoaded") == undefined){
					clearInterval(interval); 
				}
				
				if($preview.data("startLoaded")){
					clearInterval(interval); 
					
					  var itm = $preview.find(el.data('preview'));	
					  itm.css({"left": $preview.width()});
					  
					  itm.find("a.lazyload").each(function(){	
						var dd = $(this);		
						$("body").mainFm('lazyLoadInt', $(this))
					  });
					  
					  itm.find("a.lazyload_gallery").each(function(){
						  var dd2 = $(this);		
						 $("body").mainFm('lazyLoadInt', $(this))
					  });
					  
					  var pattern = $preview.find(".overlayPattern");
					  if(!isTouch){	
						pattern.show();
						 $(this).find(".addVideo").each(function(){
							$(this).find(".overlayPattern").show();
							pattern.hide();
						});
					  }else{
						   pattern.hide();
					  }
					  
					  var kk = -5;
					  var mc_ = itm;
					  var leng = 0;
					  var aniTyp  = inAnimat;
					  				  
					  itm.find('[data-animated-in]').each(function(){
						  var mc = mc_ = $(this);
						  leng = leng + 1;
						  mc.stop();							
						  var aniTyp = mc.attr("data-animated-in") !== undefined ? mc.attr("data-animated-in") : inAnimat;
						  mc.data("in", aniTyp)
						  kk = !isNaN(mc.attr("data-animated-time")) && mc.attr("data-animated-time") > kk ? Number(mc.attr("data-animated-time")) : kk+5;
						  var aniTim = !isNaN(mc.attr("data-animated-time")) ? 100*mc.attr("data-animated-time") : 100*(kk);						
						  mc.removeClass(aniTyp);
						  mc.css({"visibility":"hidden"});						  
						  setTimeout(function(){
							  if(cssAnimate){							
								  mc.css({"visibility":"visible"}).removeClass(aniTyp).addClass(aniTyp).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
									  $(this).removeClass($(this).data("in"));								  
								  });							  
							  }else{
								  mc.css({"opacity":0, "left":-25, "visibility":"visible"}).show().animate({"opacity":1, "left":0},500, "easeInOutQuad", function(){
									  $(this).removeClass($(this).data("in"));		
								  });
							  }
							
						  }, aniTim );						 			
					  });
					   
					  if(leng === 0){
						
						if(cssAnimate){ 											  
						  mc_.css({"visibility":"visible"}).removeClass(aniTyp).addClass(aniTyp).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								$(this).removeClass(aniTyp);
								if(isSmoothResize){
									$preview.delay(100).animate({"height": $(this).height()+ parseInt($preview.css("padding-top"))}, 500 , "easeInOutQuart", function(){
										$preview.css({"height": "auto"});
									});
								}	
								smothFirstLod = false;	
								
						  });	
						  
						}else{
							mc_.show().css({"visibility":"visible"}).removeClass(aniTyp);
							if(isSmoothResize){
								$preview.animate({"height": mc_.height()+ parseInt($preview.css("padding-top"))}, 500 , "easeInOutQuart", function(){
									$preview.css({"height": "auto"});
								});
							}
							smothFirstLod = false;		
												  	
						}	
									   
					}						
					 
					  if(isFullScreen){		
						  itm.show().css({"left": 0, "opacity":1}).find('.resize_align').each(function(){								
							  $("body").mainFm('resizeImg', $(this));
							  $("body").mainFm('scroll_update');							  
							});	
							if(cssAnimate){
								$preview.find(el.data('preview')).stop().css({"left": 0, "opacity":0}).show()[animateSyntax]({"opacity": 1}, 500, "easeInOutQuart");
							}else{
								$preview.find(el.data('preview')).show().stop().css({"left": 25, "opacity":0}).animate({"left": 0, "opacity":1},500, "easeInOutQuad", function(){
								 $("body").mainFm('scroll_update');		
								});
							}
						}else{
							if(cssAnimate){ 	
								$preview.find(el.data('preview')).show().stop().css({"left": 0});
								 $("body").mainFm('scroll_update');	
							}else{
								$preview.find(el.data('preview')).show().stop().css({"left": 25, "opacity":0}).animate({"left": 0, "opacity":1},500, "easeInOutQuad", function(){
								 $("body").mainFm('scroll_update');		
								});
							}
							
					  }
				}
			}, 50);				  
  
				  
			$carouselItems.removeClass( 'current-img' );
			el.addClass( 'current-img' );
			if(!$($carouselEl).parent().parent().parent().hasClass("withoutThumb")){
				carousel.setCurrent( pos );	
			}

			$carouselEl.data("cur",pos);		
			

			prevBtn.css({"opacity":1});
			nextBtn.css({"opacity":1});
			
			if(pos > $carouselItems.length-2){
				nextBtn.css({"opacity":.5});				
			}
			
			if(pos < 1){
				prevBtn.css({"opacity":.5});
			}	
			
			current = pos;
					
			var tim = $carouselEl.data("fLod") === undefined ?  3500 : 1200;
			$carouselEl.data("fLod" , true)

			setTimeout(function(){
				
				if(mc.data("thu").hasClass("miniView")){
					if(mc.data("thu").data("cHovBtn") === "nx"){
						var cur = $carouselItems.length-1 > pos ? pos+1 : 0;						
						carousel._slideToItem(cur);
					}else{
						var cur = pos > 0 ? pos-1 : $carouselItems.length-1;
						carousel._slideToItem(cur);
					}
				}
			},tim);

		}
		
		$carouselEl.data("fn",changeImage);
		$carouselEl.data("pl",carousel);
		
		
}





// Google map Code



var gMapStore;
var mapPos;
var latlng;
var wHig_ = window.innerHeight;
var pointerVerPos = wHig_ > 360 ? wHig_/2 - 180 :  wHig_/2 - 75;

function map_initialize() {
  "use strict";  
  
	var map;
	var openedInfoWindow = null;
	
	mapPos = new google.maps.LatLng(34.05223, -118.24368);
	latlng = mapPos;

	var MY_MAPTYPE_ID = 'custom_style';
  
  	  var featureOpts = [
    {
      stylers: [
        { hue: "#222222" },
        { visibility: 'simplified' },
        { saturation: -100 },
        { weight: .5 }
      ]
    },
    {
      elementType: 'labels',
      stylers: [
        { visibility: 'on' }
      ]
    },
    {
      featureType: 'water',
      stylers: [
        { color: '#222222' }
      ]
    }
  ];
  
  
  
 var styledMapOptions = {
	  name: 'Custom Style'
  };

  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
  
  var companyPos = mapPos;
  var settings = {
	  zoom: 15,
	  scrollwheel: false,
	  center: latlng,
	  mapTypeControl: true,
	  
	  navigationControl: true,
	  navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
	  mapTypeId: MY_MAPTYPE_ID};
		
	var map = new google.maps.Map(document.getElementById("map_canvas"), settings);	

  	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

	google.maps.Map.prototype.panToWithOffset = function(latlng, offsetX, offsetY) {
		var map = this;
		var ov = new google.maps.OverlayView();
		ov.onAdd = function() {
			var proj = this.getProjection();
			var aPoint = proj.fromLatLngToContainerPixel(latlng);
			aPoint.x = aPoint.x+offsetX;
			aPoint.y = aPoint.y+offsetY;
			map.panTo(proj.fromContainerPixelToLatLng(aPoint));
		}; 
		ov.draw = function() {}; 
		ov.setMap(this); 
	};
	
	map.panToWithOffset(latlng, 0, pointerVerPos);
	 
	var contentString = '<div id="content">'+
		'<div id="siteNotice">'+
		'</div>'+
		'<h4 id="firstHeading" class="mapStyle firstHeading">FMediastudios</h4>'+
		'<div id="mapStyle">'+
		'<p class="mapStyle">Leading web design studio</p>'+
		'</div>'+
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	
	var companyImage = new google.maps.MarkerImage('images/map/logo.png',
		new google.maps.Size(100,50),
		new google.maps.Point(0,0),
		new google.maps.Point(50,50)
	);

	var companyShadow = new google.maps.MarkerImage('images/map/logo_shadow.png',
		new google.maps.Size(130,50),
		new google.maps.Point(0,0),
		new google.maps.Point(65, 50));

	/*var companyPos = new google.maps.LatLng(57.0442, 9.9116);*/

	var companyMarker = new google.maps.Marker({
		position: companyPos,
		map: map,
		icon: companyImage,
		shadow: companyShadow,
		title:"Høgenhaug",
		zIndex: 3});
	
	gMapStore = map;
	
	google.maps.event.addListener(companyMarker, 'click', function() {
		if (openedInfoWindow != null) openedInfoWindow.close();  // <-- changed this
		infowindow.open(map,companyMarker);	
		openedInfoWindow = infowindow;
      	google.maps.event.addListener(infowindow, 'closeclick', function() {
		   map.panToWithOffset(latlng, 0, pointerVerPos);
		});	
	});
	
	var mapInterval;
	$(window).resize(function() {	
		clearInterval(mapInterval);
		mapInterval = setInterval(function(){
			clearInterval(mapInterval); 
			wHig_ = window.innerHeight;
			mapResizer();
		},700);
	});
	
}

function mapResizer(){
	pointerVerPos = 0;
	try{
	gMapStore.panToWithOffset(latlng, 0, pointerVerPos);
	} catch (e) { }
}


/* Setting tool create
$(document).ready(function(){	
	var prevz = '<div class="setting_tools hideTool">';
	prevz += '<a class="iButton"><i class="fa fa-wrench" ></i></a>'; 	
	prevz += '<div class="setting_holder">';
	prevz += '<p class="noPadding">MOVE PANEL : &nbsp; <a class="button mUp"><i class="fa fa-arrow-up" ></i></a> <a  class="button mDown"><i class="fa fa-arrow-down" ></i></a></p>'; 
	prevz += '<hr class="separator_bar   dark">';
	prevz += '<p class="first">COLOR</p>';
	prevz += '<a class="colWhite button"></a>';
	prevz += '<a class="colNight button"></a>';
	prevz += '<a class="colBlack button"></a>';
	prevz += '<p>MENU</p>';
	prevz += '<a class="mType1 button">Type 1</a>';
	prevz += '<a class="mType2 button">Type 2</a>';
	prevz += '<p>FONT</p>';
	prevz += '<a class="fontStyle2 button">Bebas Neue</a>' ;    
	prevz += '<a class="fontStyle1 button">Raleway</a>' ;
	prevz += '<p>Highlight color</p>';
	prevz += '<a class="temHigLight1 button"></a>';
	prevz += '<a class="temHigLight2 button"></a>';	
	prevz += '<a class="temHigLight3 button"></a>';
	prevz += '<p></p>';
	prevz += '</div></div>';
	$("body").prepend( prevz );
	

	/*var prevTst = '<a class="button tst"></a>'; 	
	prevTst += '<a class="button tst2"></a>';
	$("body").prepend( prevTst );

});*/