(function($) {
	"use strict";
	
	const ps = new PerfectScrollbar('.app-sidebar', {
	  useBothWheelAxes:false,
	  suppressScrollX:false,
	});
	const ps1 = new PerfectScrollbar('.sidebar-left', {
	  useBothWheelAxes:false,
	  suppressScrollX:false,
	});
	
})(jQuery);