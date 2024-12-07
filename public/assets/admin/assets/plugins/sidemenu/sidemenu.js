(function () {
	"use strict";
	
	var slideMenu = $('.side-menu');

	// Toggle Sidebar
	$(document).on('click','[data-toggle="sidebar"]',function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});
	
	$(".app-sidebar").hover(function() {
		if ($('body').hasClass('sidenav-toggled')) {
			$('body').addClass('sidenav-toggled-open');
		}
	}, function() {
		if ($('body').hasClass('sidenav-toggled')) {
			$('body').removeClass('sidenav-toggled-open');
		}
	});


	// Activate sidebar slide toggle
	$("[data-toggle='slide']").on('click',function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			slideMenu.find("[data-toggle='slide']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='slide.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();
	
	
	// ______________Active Class
	$(".app-sidebar li a").each(function() {
	  var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) { 
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().parent().parent().addClass("active"); 
			$(this).parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
})();