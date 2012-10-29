jQuery(document).ready(function($){
	var position, adresse, buttonAction, geocoder, buttonTitle;
	buttonTitle = addMapViewTitle;
	$("#whats-new-textarea").append('<a href="#" id="bpci-position-me" title="'+addCheckinTitle+'"><span>'+addCheckinTitle+'</span></a>');
	
	if( ( !$.cookie("bpci-data-delete") || $.cookie("bpci-data-delete").indexOf('delete') == -1 ) && $.cookie("bpci-data") && $.cookie("bpci-data").length > 8){
		$("#bpci-position-me").addClass('disabled');
		var tempPositionToParse = $.cookie("bpci-data").split('|');
		position = new google.maps.LatLng(tempPositionToParse[0], tempPositionToParse[1]);
		adresse = tempPositionToParse[2];
		buttonAction = 'show';
		buttonTitle = addMapViewTitle;
		$("#whats-new-textarea").append('<div id="bpci-position-inputs"><input type="hidden" name="bpci-lat" id="bpci-lat" value="'+position.lat()+'"><input type="hidden" name="bpci-lng" id="bpci-lng" value="'+position.lng()+'"><input type="text" readonly value="'+adresse+'" id="bpci-address" name="bpci-address" placeholder="'+addressPlaceholder+'"><a href="#" id="bpci-show-on-map" class="map-action" title="'+buttonTitle+'"><span>'+buttonTitle+'</span></a><a href="#" id="bpci-mod-position" class="map-action" title="'+modCheckinTitle+'"><span>'+modCheckinTitle+'</span></a><a href="#" id="bpci-reset-position" class="map-action" title="'+resetCheckinTitle+'"><span>'+resetCheckinTitle+'</span></a><div id="bpci-map" class="map-hide"></div></div>');
		
	} else {
		$("#bpci-position-me").removeClass('disabled');
	}
	$("#bpci-position-me").click(function(){
		if( $("#bpci-position-me").hasClass('disabled') != true ){
			$(this).parent().append('<div id="bpci-position-inputs"><span class="bpci-loader">loading...</span></div>');
			$("#bpci-position-me").addClass('disabled');
			buttonAction = 'show';

			$('#bpci-position-inputs').gmap3({
				action : 'geoLatLng',
		        callback : function(latLng){
					if(latLng){
						position = latLng;
						$(this).gmap3({
							action:'getAddress',
		                    latLng:latLng,
		                    callback:function(results){
								adresse = results && results[1] ? results && results[1].formatted_address : 'no address';
								$.cookie("bpci-data", latLng.lat()+"|"+latLng.lng()+"|"+adresse, { path: '/' });
								$.cookie("bpci-data-delete", '', { path: '/' });
								$("#bpci-position-inputs").html('<input type="hidden" name="bpci-lat" id="bpci-lat" value="'+latLng.lat()+'"><input type="hidden" name="bpci-lng" id="bpci-lng" value="'+latLng.lng()+'"><input type="text" readonly value="'+adresse+'" id="bpci-address" name="bpci-address" placeholder="'+addressPlaceholder+'"><a href="#" id="bpci-show-on-map" class="map-action" title="'+buttonTitle+'"><span>'+buttonTitle+'</span></a><a href="#" id="bpci-mod-position" class="map-action" title="'+modCheckinTitle+'"><span>'+modCheckinTitle+'</span></a><a href="#" id="bpci-reset-position" class="map-action" title="'+resetCheckinTitle+'"><span>'+resetCheckinTitle+'</span></a><div id="bpci-map" class="map-hide"></div>');
							}
						});
					} else {
						buttonAction = 'search';
						buttonTitle = addMapSrcTitle;
						$("#bpci-position-inputs").html('<input type="hidden" name="bpci-lat" id="bpci-lat"><input type="hidden" name="bpci-lng" id="bpci-lng"><input type="text" id="bpci-address" name="bpci-address" placeholder="'+addressPlaceholder+'"><a href="#" id="bpci-show-on-map" class="map-action" title="'+buttonTitle+'"><span>'+buttonTitle+'</span></a><a href="#" id="bpci-mod-position" class="map-action" title="'+modCheckinTitle+'"><span>'+modCheckinTitle+'</span></a><a href="#" id="bpci-reset-position" class="map-action" title="'+resetCheckinTitle+'"><span>'+resetCheckinTitle+'</span></a><div id="bpci-map" class="map-hide"></div>');
						alert(html5LocalisationError);
						$("#bpci-address").focus();
					}
				}
			});
			
		}
		
		return false;
	});
	
	
	$('#bpci-show-on-map').live( 'click', function(){
		$("#bpci-map").show();
		
		if( buttonAction == 'show' ) {
			$("#bpci-map").gmap3({
	            action: 'addMarker', 
	            latLng:position,
				map:{
					center: position,
					zoom: 16
				}
			},
			{
				action : 'clear',
				name: 'marker'
			},
			{ action:'addOverlay',
	          latLng: position,
	          options:{
	            content: '<div class="bpci-avatar"><s></s><i></i><span>' + $("#whats-new-avatar").html() + '</span></div>',
	            offset:{
	              y:-40,
	              x:10
	            }
	          }
			});
		} else if( buttonAction == 'search' ) {
			address = $('#bpci-address').val();

			geocoder = new google.maps.Geocoder();

			geocoder.geocode( { 'address': address}, function(results, status) {
			    /* Si l'adresse a pu être géolocalisée */
			    if (status == google.maps.GeocoderStatus.OK) {
			     /* Récupération de sa latitude et de sa longitude */
			     var glat = results[0].geometry.location.lat();
			     var glng = results[0].geometry.location.lng();
			     position = new google.maps.LatLng(glat, glng);

				$('#bpci-map').gmap3({
		            action: 'addMarker', 
		            latLng:position,
					map:{
						center: position,
						zoom: 16
					},
					callback : function(marker){
						$(this).gmap3({
		                    action:'getAddress',
		                    latLng:marker.getPosition(),
		                    callback:function(results){
		                      	adresse = results && results[1] ? results && results[1].formatted_address : 'no address';
								$('#bpci-address').val(adresse);
								$("#bpci-address").attr("readonly","readonly");
								$("#bpci-lat").val( position.lat() );
								$("#bpci-lng").val( position.lng() );
								$.cookie("bpci-data", position.lat()+"|"+position.lng()+"|"+adresse, { path: '/' });
								$.cookie("bpci-data-delete", '', { path: '/' });
								buttonAction = 'show';
								$('#bpci-show-on-map').attr('title',addMapViewTitle);
		                    }
		                  });
					}
				},
				{
					action : 'clear',
					name: 'marker'
				},
				{ action:'addOverlay',
		          latLng: position,
		          options:{
		            content: '<div class="bpci-avatar"><s></s><i></i><span>' + $("#whats-new-avatar").html() + '</span></div>',
		            offset:{
		              y:-40,
		              x:10
		            }
		          }
				});

			     } else {
			      alert( addErrorGeocode+": " + status);
			     }
			    });
		}
		
		return false;
	});
	
	$('#bpci-mod-position').live( 'click', function(){
		$("#bpci-map").gmap3({
			action : 'clear',
			name: 'overlay'
		});
		$("#bpci-map").hide();
		buttonAction = 'search';
		$('#bpci-show-on-map').attr('title',addMapSrcTitle);
		$("#bpci-address").val("");
		$("#bpci-address").attr("readonly",false);
		$("#bpci-address").focus();
		/* need to write over this cookie
		$.cookie("bpci-data", null);*/
		return false;
	});
	
	$('#bpci-reset-position').live( 'click', function(){
		$("#bpci-map").gmap3({
			action : 'clear',
			name: 'overlay'
		});
		$("#bpci-position-me").removeClass('disabled');
		$('#bpci-position-inputs').remove();
		buttonAction = 'show';
		buttonTitle = addMapViewTitle;
		$.cookie("bpci-data-delete", 'delete', { path: '/' });
		return false;
	});
	
	$("input#aw-whats-new-submit").click( function() {
		$("#bpci-map").hide();
	});
	
});