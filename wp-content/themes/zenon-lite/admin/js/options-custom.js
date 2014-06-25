/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	
$('#of-option-frontpage').prepend('<div class="sub_nav"><a class="znctrl_curnt znctrl_lays">Layouts</a><a class="znctrl_bloc">Blocks</a><a class="znctrl_soc">Social</a></div>');
	$('#section-blocks_checkbox, #section-block1_text, #section-block1_textarea, #section-block2_text, #section-block2_text, #section-block2_textarea, #section-block3_text, #section-block3_textarea, #section-block4_text, #section-block4_textarea').wrapAll('<div class="zn_blocks_wrap" />');
		$('#section-fbsoc_text, #section-ttsoc_text, #section-gpsoc_text, #section-ytbsoc_text, #section-flkrsoc_text, #section-lnkdsoc_text, #section-pinsoc_text, #section-rsssoc_text').wrapAll('<div class="zn_social_wrap" />');

$('#section-layout_images, #section-latstpst_checkbox').wrapAll('<div class="zn_lays_wrap" />');
	
	$('.zn_blocks_wrap, .zn_social_wrap').hide();
	$("#sub_log, #sub_shrt, #sub_misc").hide();
	

$(".znctrl_lays").click(function () {
$(".znctrl_bloc, .znctrl_soc").removeClass('znctrl_curnt');
$(".znctrl_lays").addClass('znctrl_curnt');
$('.zn_lays_wrap').show('medium');
$('.zn_blocks_wrap, .zn_social_wrap').hide('medium');
});

$(".znctrl_bloc").click(function () {
$(".znctrl_lays, .znctrl_soc").removeClass('znctrl_curnt');
$(".znctrl_bloc").addClass('znctrl_curnt');
$('.zn_blocks_wrap').show('medium');
$('.zn_lays_wrap, .zn_social_wrap').hide('medium');
});

$(".znctrl_soc").click(function () {
$(".znctrl_bloc, .znctrl_lays").removeClass('znctrl_curnt');
$(".znctrl_soc").addClass('znctrl_curnt');
$('.zn_social_wrap').show('medium');
$('.zn_blocks_wrap, .zn_lays_wrap').hide('medium');
});

$(".znctrl_wdgt").click(function () {
$(".znctrl_shrtcd, .znctrl_misc, .znctrl_sldr, .znctrl_misc").removeClass('znctrl_curnt');
$(".znctrl_wdgt").addClass('znctrl_curnt');
$('#sub_log').show('medium');
$('#sub_comm, #sub_shrt, #sub_misc').hide('medium');
});

	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		$(Othis).children('div').css('backgroundColor', '#' + hex);
		$(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
	
	// Switches option sections
	$('.group').hide();
	var activetab = '';
	if (typeof(localStorage) != 'undefined' ) {
		activetab = localStorage.getItem("activetab");
	}
	if (activetab != '' && $(activetab).length ) {
		$(activetab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	
	if (activetab != '' && $(activetab + '-tab').length ) {
		$(activetab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
	});
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
		 		
});	