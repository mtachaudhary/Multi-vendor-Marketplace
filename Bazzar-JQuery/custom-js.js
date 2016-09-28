// JavaScript Document
	
	//Start Scrolling Function
	$(function() {
		$('a.smooth').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top
			}, 1000);
			return false;
		  }
		}
	  });
	});
	//END Scrolling Function

    $(document).ready(function() {

	  //Start Sticky Navbar
	  $('#nav').affix({
		offset: {
		  top: $('.ht').height()
		}
	  });
	  //END Sticky Navbar
	  
	  // Start My Account dropdown
	  $('#account').click(function() {
		  $('#account ul').fadeToggle();
	  });
	  $('#account .dropdown').mouseleave(function() {
		  $(this).fadeOut();
	  });
	  // END My Account dropdown
	  
	  // Start Navbar dropdown
	  $('#nav ul.nav > li').hover(function(){
			$(this).find('.main-drop').show();
		},function(){
			$(this).find('.main-drop').hide();
	  });
	  $('li#categories ul > li').hover(function(){
		  $(this).find('.subdrop').show();
		},function(){
		  $(this).find('.subdrop').hide();
	  });
	  // END Navbar dropdown
	  
	  // Start shopping-cart
      $('.shopping-cart').click(function() {
      	$('.shopping-content').fadeToggle();
	  });
	  $('.shopping-content').mouseleave(function() {
		  $(this).fadeOut();
	  });
	  // END shopping-cart
	  
	  // Start Product Advertisement
	  $('#nav ul.nav li').click(function() {
		  $('ul.nav li.active').removeClass('active');
        $(this).addClass('active');
	  });
	  // END Product Advertisement
	  
	  $('.sp-cat').click(function(e) {
		  $('.show-submenu').slideUp(500);
		  $(this).parent('li').find('ul').slideToggle(500);
        
      });
	  
	  var owl = $("#owl-demo");
      owl.owlCarousel({
          items : 4, //10 items above 1000px browser width
          itemsDesktop : [1000,5], //5 items between 1000px and 901px
          itemsDesktopSmall : [900,3], // betweem 900px and 601px
          itemsTablet: [600,2], //2 items between 600 and 0
          itemsMobile : [360,1], // itemsMobile disabled - inherit from itemsTablet option
		  pagination : false,
      });
     
      // Start Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      });
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      });
	  // END Custom Navigation Events
	  
	  // Start Slogan-Slider
	  $("#owl-slogan").owlCarousel({
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  autoPlay:true,
	  stopOnHover: true,
	  });
	  // END Slogan-Slider
	  
	  // Start Top Saller-Slider
	  $("#owl-seller").owlCarousel({
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  autoPlay:true,
	  stopOnHover: true,
	  });
	  // END Top Saller-Slider
	  
	  //Start Isotope Filter
	  var $container = $('#container');
	  $container.isotope({
	  });
	  $container.isotope({ filter: '.fashion' });
	  $('#filters a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
	  });
	  //END Isotope Filter
	  
	  // Start Active Shop by categories
	  $('#filters li a').click(function() {
		  $('a.active').removeClass('active');
        $(this).addClass('active');
	  });
	  // END Active Shop by categories
	    
    });
	
	


