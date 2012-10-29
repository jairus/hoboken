<?php
/* 
Plugin Name: BP checkins
Plugin URI: http://imath.owni.fr/2012/04/01/bp-checkins/
Description: BuddyPress 1.5+ plugin to add checkins to profile or group updates.
Version: 0.1
Author: imath
Author URI: http://imath.owni.fr
License: GPLv2
Network: true
*/

/* définition des constantes */
define ( 'BP_CHECKINS_SLUG', 'checkins' );
define ( 'BP_CHECKINS_PLUGIN_NAME', 'bp-checkins' );
define ( 'BP_CHECKINS_PLUGIN_URL',  plugins_url('' , __FILE__) );
define ( 'BP_CHECKINS_PLUGIN_URL_JS',  plugins_url('js' , __FILE__) );
define ( 'BP_CHECKINS_PLUGIN_URL_CSS',  plugins_url('css' , __FILE__) );
define ( 'BP_CHECKINS_PLUGIN_URL_IMG',  plugins_url('images' , __FILE__) );
define ( 'BP_CHECKINS_PLUGIN_DIR',  WP_PLUGIN_DIR . '/' . BP_CHECKINS_PLUGIN_NAME );
define ( 'BP_CHECKINS_PLUGIN_VERSION', '0.1');


function bp_checkins_load_gmap3() {
	if( bp_is_group_home() || bp_is_activity_component() || bp_is_user_friends() ) {
		wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor=false' );
		wp_enqueue_script( 'gmap3', BP_CHECKINS_PLUGIN_URL_JS . '/gmap3.min.js', array('jquery') );
		
		wp_enqueue_style( 'bpcistyle', BP_CHECKINS_PLUGIN_URL_CSS . '/bpcinstyle.css');
		
		if( /*bp_is_current_action( 'p' )*/ $_GET['map'] == 1 ) {
			global $bpci_lat, $bpci_lng;
			$bpci_lat = bp_activity_get_meta( bp_current_action(), 'bpci_activity_lat' );
			$bpci_lng = bp_activity_get_meta( bp_current_action(), 'bpci_activity_lng' );

			if( !empty( $bpci_lat ) && !empty( $bpci_lng ) ) {
				add_action('wp_head', 'bp_checkins_item_map');
			}
		} elseif( bp_is_user_friends() && !bp_is_friend_requests()){
			wp_enqueue_script( 'bp-ckeckins-friends', BP_CHECKINS_PLUGIN_URL_JS . '/bp-checkins-friends.js' );
		} else {
			wp_enqueue_script( 'bp-ckeckins', BP_CHECKINS_PLUGIN_URL_JS . '/bp-checkins.js' );
			add_action('wp_head', 'bp_checkins_messages_map');
		}
	}
}

add_action('bp_actions', 'bp_checkins_load_gmap3');

function bp_checkins_item_map() {
	global $bpci_lat, $bpci_lng;
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			var bpciPosition = new google.maps.LatLng(<?php echo $bpci_lat;?>,<?php echo $bpci_lng;?>);
			
			adresse = $(".update-checkin").html();
			
			$(".activity-checkin").append('<div id="bpci-map"></div>');
			$(".activity-checkin").css('width','100%');
			
			$("#bpci-map").gmap3({
	            action: 'addMarker', 
	            latLng:bpciPosition,
				map:{
					center: true,
					zoom: 16
				}
			},
			{
				action : 'clear',
				name: 'marker'
			},
			{ action:'addOverlay',
	          latLng: bpciPosition,
	          options:{
	            content: '<div class="bpci-avatar"><s></s><i></i><span>' + $(".activity-avatar").html() + '</span></div>',
	            offset:{
	              y:-40,
	              x:10
	            }
	          }
			});
		});
		
	</script>
	<?php
}

function bp_checkins_messages_map(){
	?>
	<script type="text/javascript">
	/* internationalization ! */
	var addCheckinTitle = "<?php _e('Add a check-in!','bp-checkins');?>";
	var addMapViewTitle = "<?php _e('View on map','bp-checkins');?>";
	var addMapSrcTitle = "<?php _e('Search address','bp-checkins');?>";
	var modCheckinTitle = "<?php _e('Edit your position','bp-checkins');?>";
	var resetCheckinTitle = "<?php _e('Cancel this check-in','bp-checkins');?>";
	var addErrorGeocode = "<?php _e('OOps, we could not geocode your address for this reason','bp-checkins');?>";
	var addressPlaceholder = "<?php _e('type your address','bp-checkins');?>";
	var html5LocalisationError = "<?php _e('OOps, we could not localized you, you can search for your address in the field that received the focus.','bp-checkins');?>";
	</script>
	<?php
}

/**
* Hooking activity updates recording (regular or group ones)
* to store geodata if user allowed us to do so..
*/
add_action( 'bp_activity_posted_update', 'bp_checkins_record_geoloc_meta', 9, 3 );
add_action( 'bp_groups_posted_update', 'bp_checkins_record_group_geoloc_meta', 9, 4);

function bp_checkins_record_group_geoloc_meta( $content, $user_id, $group_id, $activity_id ) {
	bp_checkins_record_geoloc_meta( $content, $user_id, $activity_id );
}

function bp_checkins_record_geoloc_meta( $content, $user_id, $activity_id ){
	
	/* javascript disabled */
	if( isset( $_POST['bpci-lat'] ) ) {
		$lat = $_POST['bpci-lat'];
		$lng = $_POST['bpci-lng'];
		$address = $_POST['bpci-address'];
	}
	else{
		$_BP_COOKIE = wp_parse_args( str_replace( '; ', '&', urldecode( $_POST['cookie'] ) ) );
		
		if( $_BP_COOKIE['bpci-data-delete'] == "delete")
			return false;
			
		if( strlen( $_BP_COOKIE['bpci-data'] ) < 2 )
			return false;
			
		$geotable = explode('|', $_BP_COOKIE['bpci-data'] );
		$lat = $geotable[0];
		$lng = $geotable[1];
		$address = $geotable[2];
	}
	
	if( !empty($lat) && !empty($lng) && !empty($address) ) {
		
		// let's add some meta to activity
		bp_activity_update_meta( $activity_id, 'bpci_activity_lat', $lat );
		bp_activity_update_meta( $activity_id, 'bpci_activity_lng', $lng );
		bp_activity_update_meta( $activity_id, 'bpci_activity_address', $address );
		
		// let's update latest user's position for 'show my friends on map' feature
		bp_update_user_meta( $user_id, 'bpci_latest_lat', $lat );
		bp_update_user_meta( $user_id, 'bpci_latest_lng', $lng );
		bp_update_user_meta( $user_id, 'bpci_latest_address', $address );
		
	}
	
}

/**
* Hooking activity display to show the user's checkin
*
*/
add_action( 'bp_activity_entry_content', 'bp_checkins_display_user_checkin');

function bp_checkins_display_user_checkin(){
	/*if ( 'activity_comment' == bp_get_activity_type() )
		return false;*/
		
	$activity_id = bp_get_activity_id();
	$activity_permalink = bp_activity_get_permalink( $activity_id ) . '?map=1';
	
	$address = bp_activity_get_meta( $activity_id, 'bpci_activity_address' );
	
	if( $address ){
		?>
		<div class="activity-checkin">
			<a href="<?php echo $activity_permalink;?>" title="<?php _e('Open the map for this update', 'bp-checkins');?>" class="link-checkin"><span class="update-checkin"><?php echo stripslashes( $address );?></span></a>
		</div>
		<?php
	}
	
}

add_filter( 'bp_activity_permalink_redirect_url', 'bp_checkins_handle_bp_redirection');

function bp_checkins_handle_bp_redirection( $redirect ) {
	if( $_GET['map'] == 1 )
		return $redirect . '?map=1';
		
	else
		return $redirect;
}

add_action('bp_directory_members_actions', 'bp_checkins_add_friend_position', 99);

function bp_checkins_add_friend_position(){
	if( bp_is_user_friends() ) {
		
		$user_id = bp_get_member_user_id();
		
		$lat = bp_get_user_meta( $user_id, 'bpci_latest_lat', true );
		$lng = bp_get_user_meta( $user_id, 'bpci_latest_lng', true );
		$address = bp_get_user_meta( $user_id, 'bpci_latest_address', true );
		
		if($lat && $lng && $address){
			?>
			<div class="activity-checkin">
				<a href="#bpci-map" title="<?php _e('Center the map on this friend', 'bp-checkins');?>" id="friend-<?php echo $user_id;?>" rel="<?php echo $lat.','.$lng;?>" class="link-checkin"><span class="update-checkin"><?php echo stripslashes( $address );?></span></a>
			</div>
			<?php
		}
	}
}

add_action('bp_before_member_friends_content', 'bp_checkins_load_friends_map');

function bp_checkins_load_friends_map(){
	$user_id = bp_displayed_user_id();
	
	if(!$user_id) return false;
	
	$lat = bp_get_user_meta( $user_id, 'bpci_latest_lat', true );
	$lng = bp_get_user_meta( $user_id, 'bpci_latest_lng', true );
	$address = bp_get_user_meta( $user_id, 'bpci_latest_address', true );
	?>
	<div id="bpci-map_container"></div>
	
		<script type="text/javascript">
			var displayedUserLat = "<?php echo $lat;?>";
			var displayedUserLng = "<?php echo $lng;?>";
			var displayedUserAddress = "<?php echo $address;?>";
		</script>
	
	<?php
}

/**
* bp_checkins_load_textdomain
* translation!
* 
*/
function bp_checkins_load_textdomain() {

	// try to get locale
	$locale = apply_filters( 'bp_checkins_load_textdomain_get_locale', get_locale() );

	// if we found a locale, try to load .mo file
	if ( !empty( $locale ) ) {
		// default .mo file path
		$mofile_default = sprintf( '%s/languages/%s-%s.mo', BP_CHECKINS_PLUGIN_DIR, BP_CHECKINS_PLUGIN_NAME, $locale );
		// final filtered file path
		$mofile = apply_filters( 'bp_checkins_load_textdomain_mofile', $mofile_default );
		// make sure file exists, and load it
		if ( file_exists( $mofile ) ) {
			load_textdomain( BP_CHECKINS_PLUGIN_NAME, $mofile );
		}
	}
}
add_action ( 'bp_init', 'bp_checkins_load_textdomain', 2 );

function bp_checkins_install(){
	if( !get_option('bp-checkins-version') || "" == get_option('bp-checkins-version')){
		update_option('bp-checkins-version', BP_CHECKINS_PLUGIN_VERSION);
	}
}

register_activation_hook( __FILE__, 'bp_checkins_install' );
?>