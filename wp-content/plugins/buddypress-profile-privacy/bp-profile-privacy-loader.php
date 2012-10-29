<?php
/*
Plugin Name: BuddyPress Profile Privacy
Plugin URI: http://buddypress.org
Description: Allows users to hide profile sections and "permissions" to be set for xprofile fields.
Version: 1.4.2
Requires at least: WP 3.2, BuddyPress 1.5
Tested up to: WP 3.2, BuddyPress 1.5
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
Author: modemlooper 
Author URI: http://twitter.com/modemlooper
*/

/*Partial code ported from bp-profile-privacy plugin by Jeff Farthing */

/*
 * Make sure BuddyPress is loaded before we do anything.
 */
if ( !function_exists( 'bp_core_install' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );
	} else {
		add_action( 'admin_notices', 'bp_profile_privacy_install_buddypress_notice' );
		return;
	}
}


function bp_profile_privacy_install_buddypress_notice() {
	echo '<div id="message" class="error fade bp-verified-upgraded"><p style="line-height: 150%">';
	_e('<strong>BuddyPress Profile Privacy</strong></a> requires the BuddyPress plugin to work. Please <a href="http://buddypress.org/download">install BuddyPress</a> first, or <a href="plugins.php">deactivate BuddyPress Profile Privacy</a>.');
	echo '</p></div>';
}

/* Only load the component if BuddyPress is loaded and initialized. */
function bp_profile_privacy_init() {
	// Check if xprofile is active
	if ( !function_exists( 'xprofile_insert_field_group' ) )
		return;
		
	if ( !$admin_settings = get_option( 'bp_profile_privacy' ) )
		bp_profile_privacy_install();

	require( dirname( __FILE__ ) . '/bp-profile-privacy-core.php' );
	
}
add_action( 'bp_init', 'bp_profile_privacy_init' );
require( dirname( __FILE__ ) . '/bp-profile-privacy-sections.php' );

function bp_profile_privacy_install() {
	// Check if xprofile is active
	if ( !function_exists( 'xprofile_install' ) )
		return false;
		
	if ( $admin_settings = get_option( 'bp_profile_privacy' ) )
		return true;
		
	$groups = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
	
	$fields = array();
	foreach ( $groups as $group ) {
		if ( isset( $group->fields ) && is_array( $group->fields ) ) {
			foreach ( $group->fields as $field ) {
				$fields[$field->id] = 0;
			}
		}
	}
	
	return update_option( 'bp_profile_privacy', $fields );
}
register_activation_hook( __FILE__, 'bp_profile_privacy_install' );

function bp_profile_privacy_uninstall() {
	delete_option( 'bp_profile_privacy' );
}
register_uninstall_hook( __FILE__, 'bp_profile_privacy_uninstall' );

?>