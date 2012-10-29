$(document).ready(function(){

// BREADCRUMB
$("#breadCrumb3").jBreadCrumb();

// HOME SLIDER						
$('#accordion-1').easyAccordion({
autoStart: true, 
slideInterval: 5000,
slideNum: true
});

// MAPS
$('#locations-map').vectorMap({
map: 'usa_en',
color: '#aaa',
hoverColor: false,
hoverOpacity: 0.5,
colors: {nj:'#ee5a9a', ny:'#888888', tx:'#888888', dc:'#888888', fl:'#888888', ca:'#888888', ct:'#888888'},
backgroundColor: '#ffffff'
});

// TOOLTIPS
var $soc_top;
$('.trigger').each(function() {
$(this).hover(function() {
$('body > .soc-info').remove();
var $span = $('> span', this);
var $old_html = $span.html();
var $new_html = '<span class="soc-info"><span class="soc-cont">' + $span.html() + '<span class="soc-b"></span></span></span>';
$('body').append($new_html);
$soc_top = $('body > .soc-info');
if ($.browser.msie && $.browser.version < 9) {
$soc_top.css({ 'left' : $(this).offset().left-1, 'top' : $(this).offset().top-25, 'z-index' : '999', 'display' : 'block' })
} else {
$soc_top.css({ 'left' : $(this).offset().left-1, 'top' : $(this).offset().top-25, 'z-index' : '999', 'display' : 'block' }).fadeIn(300)
}
}, function() {
$soc_top.fadeOut(1000, function () {$(this).remove()});
});
});

// ANIMATE CITY ON LOAD
$('#accordion-1').hide().slideDown(2000);
$('.parallax-layer-1').hide().fadeIn(4000);
$('.parallax-layer-2').hide().fadeIn(2000);
$('.parallax-layer-3').hide().fadeIn(5000);

// ANIMATE CITY ON HOVER
$('.logo a').hover(function() {
$('.parallax-layer-1').animate({left:'-=8'},{queue: false});
$('.parallax-layer-2').animate({left:'+=2', top:'-=5'},{queue: false});
$('.parallax-layer-3').animate({left:'-=5'},{queue: false});
}, function() {
$('.parallax-layer-1').animate({left:'0'},{queue: false});
$('.parallax-layer-2').animate({left:'0', top:'0'},{queue: false});
$('.parallax-layer-3').animate({left:'0'},{queue: false});
});

// SORT 
$("#allcat").click(function() {
$(".classified-item").show();
$(".classified-picker a").removeClass("current");
$(this).addClass("current");
return false;
});
$(".filter").click(function() {
var thisFilter = $(this).attr("id");
$(".classified-item").hide();
$("."+ thisFilter).fadeIn('slow');
$(".classified-picker a").removeClass("current");
$(this).addClass("current");
return false;
});


	var j = jQuery;
		
	// topic follow/mute
	j(".ass-topic-subscribe > a").click( function() {
		it = j(this);
		var theid = j(this).attr('id');
		var stheid = theid.split('-');
		
		//j('.pagination .ajax-loader').toggle();
			
		var data = {
			action: 'ass_ajax',
			a: stheid[0],
			topic_id: stheid[1]
			//,_ajax_nonce: stheid[2]
		};
				
		// TODO: add ajax code to give status feedback that will fade out
				
		j.post( ajaxurl, data, function( response ) {
			if ( response == 'follow' ) {
				var m = bp_ass.mute;
				theid = theid.replace( 'follow', 'mute' );
			} else if ( response == 'mute' ) {
				var m = bp_ass.follow;
				theid = theid.replace( 'mute', 'follow' );
			} else {
				var m = bp_ass.error;
			}
					
			j(it).html(m);
			j(it).attr('id', theid);
			j(it).attr('title', '');
			
			//j('.pagination .ajax-loader').toggle();
			
		});
	});


	// group subscription options
	j(".group-sub").live("click", function() {
		it = j(this);
		var theid = j(this).attr('id');
		var stheid = theid.split('-');
		group_id = stheid[1];
		current = j( '#gsubstat-'+group_id ).html();
		j('#gsubajaxload-'+group_id).toggle();
		
		var data = {
			action: 'ass_group_ajax',
			a: stheid[0],
			group_id: stheid[1]
			//,_ajax_nonce: stheid[2]
		};
		
		j.post( ajaxurl, data, function( response ) {
			status = j(it).html();
			if ( !current || current == 'No Email' ) {
				j( '#gsublink-'+group_id ).html('change');
				//status = status + ' / ';
			}
			j( '#gsubstat-'+group_id ).html( status ); //add .animate({opacity: 1.0}, 2000) to slow things down for testing
			j( '#gsubstat-'+group_id ).addClass( 'gemail_icon' );
			j( '#gsubopt-'+group_id ).slideToggle('fast');
			j( '#gsubajaxload-'+group_id ).toggle();
		});		
		
	});
		
	j('.group-subscription-options-link').live("click", function() {
		stheid = j(this).attr('id').split('-');
		group_id = stheid[1];
		j( '#gsubopt-'+group_id ).slideToggle('fast');
	});
	
	j('.group-subscription-close').live("click", function() {
		stheid = j(this).attr('id').split('-');
		group_id = stheid[1];
		j( '#gsubopt-'+group_id ).slideToggle('fast');
	});
	
	//j('.ass-settings-advanced-link').click( function() {
	//	j( '.ass-settings-advanced' ).slideToggle('fast');
	//});
	
	j('.group-subscription-options').hide();

	// Toggle welcome email fields on group email options page
	j('#ass-welcome-email-enabled').change(function() {
		if ( j(this).prop('checked') ) {
			j('.ass-welcome-email-field').show();
		} else {
			j('.ass-welcome-email-field').hide();
		}
	});


});