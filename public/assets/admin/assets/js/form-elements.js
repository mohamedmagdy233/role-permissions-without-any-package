$(function(e) {
	'use strict'
	
	// Toggles
	$('.toggle').toggles({
		on: true,
		height: 26
	});
	
	// Input Masks
	$('#dateMask').mask('99/99/9999');
	$('#phoneMask').mask('(999) 999-9999');
	$('#ssnMask').mask('999-99-9999');
	
	// Time Picker
	$('#tpBasic').timepicker();
	$('#tp2').timepicker({
		'scrollDefault': 'now'
	});
	
	$('#tp3').timepicker();
	
	$(document).on('click', '#setTimeButton', function() {
		$('#tp3').timepicker('setTime', new Date());
	});
	
	
	// Color picker
	$('#colorpicker').spectrum({
		color: '#0061da'
	});
	$('#showAlpha').spectrum({
		color: 'rgba(0, 97, 218, 0.5)',
		showAlpha: true
	});
	$('#showPaletteOnly').spectrum({
		showPaletteOnly: true,
		showPalette: true,
		color: '#DC3545',
		palette: [
			['#1D2939', '#fff', '#0866C6', '#23BF08', '#F49917'],
			['#DC3545', '#17A2B8', '#6610F2', '#fa1e81', '#72e7a6']
		]
	});
	
	//Date range picker
	$('#reservation').daterangepicker();
	
	// Datepicker
	$('.fc-datepicker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
	});
	$('#datepickerNoOfMonths').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true,
		numberOfMonths: 2
	});
	
	//file-browser
	$(document).on('change', ':file', function() {
	var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready( function() {
	  $(':file').on('fileselect', function(event, numFiles, label) {

		  var input = $(this).parents('.input-group').find(':text'),
			  log = numFiles > 1 ? numFiles + ' files selected' : label;

		  if( input.length ) {
			  input.val(log);
		  } else {
			  if( log ) alert(log);
		  }

	  });
	});
});
