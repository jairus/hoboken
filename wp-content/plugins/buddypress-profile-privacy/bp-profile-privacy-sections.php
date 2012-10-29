<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/* ------- Check if member is a friend  ------------- original code snippet by @pollyplummer */
function bp_displayed_user_is_friend() {
	global $bp;
		if ( ('is_friend' != BP_Friends_Friendship::check_is_friend( $bp->loggedin_user->id, $bp->displayed_user->id )) )
	return true;

}


function bp_profile_privacy_is_set(){
	global $bp;
	if ( (get_user_meta($bp->displayed_user->id, 'bp-profile-privacy', 1) == '1') && (bp_loggedin_user_id() != bp_displayed_user_id()) && bp_displayed_user_is_friend()  )	
	return true;
}

function bp_activity_privacy_is_set(){
	global $bp;
	if ( (get_user_meta($bp->displayed_user->id, 'bp-activity-privacy', 1) == '1') && (bp_loggedin_user_id() != bp_displayed_user_id()) && bp_displayed_user_is_friend() )
	return true;
}

function bp_group_privacy_is_set(){
	global $bp;
	if ( (get_user_meta($bp->displayed_user->id, 'bp-group-privacy', 1) == '1') && (bp_loggedin_user_id() != bp_displayed_user_id()) && bp_displayed_user_is_friend() )
	return true;
}

function bp_friend_privacy_is_set(){
	global $bp;
	if ( (get_user_meta($bp->displayed_user->id, 'bp-friend-privacy', 1) == '1') && (bp_loggedin_user_id() != bp_displayed_user_id()) && bp_displayed_user_is_friend() )
	return true;
}

function bp_forum_privacy_is_set(){
	global $bp;
	if ( (get_user_meta($bp->displayed_user->id, 'bp-forum-privacy', 1) == '1') && (bp_loggedin_user_id() != bp_displayed_user_id()) && bp_displayed_user_is_friend() )
	return true;
}

function bp_setup_privacy_nav() {
	global $bp;
	
		/* Add a nav item for this*/
	bp_core_new_subnav_item( array(
		'name' => __( 'Privacy', 'bp-profile-privacy' ),
		'slug' => 'privacy',
		'parent_slug' => $bp->settings->slug,
		'parent_url' => $bp->loggedin_user->domain . $bp->settings->slug . '/',
		'screen_function' => 'bp_privacy_screen_settings_menu',
		'position' => 40,
		'user_has_access' => bp_is_my_profile() // Only the logged in user can access this on his/her profile
	) );
}
add_action( 'bp_setup_nav', 'bp_setup_privacy_nav' );


function bp_privacy_screen_settings_menu() {

	global $bp, $current_user, $bp_settings_updated, $pass_error;

/* thanks @Boone! */
	
		if ( isset( $_POST['submit'] )) {
			if (isset($_POST['bp-profile-privacy'])) {
			update_user_meta($bp->loggedin_user->id, 'bp-profile-privacy', '1');
			} else {
			update_user_meta($bp->loggedin_user->id, 'bp-profile-privacy', '0');
			}
			
			if (isset($_POST['bp-activity-privacy'])) {
			update_user_meta($bp->loggedin_user->id, 'bp-activity-privacy', '1');
			} else {
			update_user_meta($bp->loggedin_user->id, 'bp-activity-privacy', '0');
			}
			
			if (isset($_POST['bp-group-privacy'])) {
			update_user_meta($bp->loggedin_user->id, 'bp-group-privacy', '1');
			} else {
			update_user_meta($bp->loggedin_user->id, 'bp-group-privacy', '0');
			}
			
			if (isset($_POST['bp-friend-privacy'])) {
			update_user_meta($bp->loggedin_user->id, 'bp-friend-privacy', '1');
			} else {
			update_user_meta($bp->loggedin_user->id, 'bp-friend-privacy', '0');
			}
			if (isset($_POST['bp-forum-privacy'])) {
			update_user_meta($bp->loggedin_user->id, 'bp-forum-privacy', '1');
			} else {
			update_user_meta($bp->loggedin_user->id, 'bp-forum-privacy', '0');
			}
			
	 	bp_core_add_message( 'Settings updated!' );
	 	bp_core_redirect( bp_displayed_user_domain() . $bp->settings->slug . '/privacy' );
	 
	 	}
	 	
	add_action( 'bp_template_content', 'bp_privacy_screen_settings_menu_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	
}


function bp_privacy_screen_settings_menu_content() {
	global $bp;
?>
<h2>Privacy</h2>

<form action="" method="post" id="standard-form" name="settings-form">

<p><input name="bp-profile-privacy" type="checkbox" id="bp-profile-privacy" value="1" <?php if (get_user_meta($bp->displayed_user->id, 'bp-profile-privacy',1) == '1') echo 'checked="checked"' ?> tabindex="99" /> <?php _e( 'only show profile to friends', 'bp-profile-privacy' ); ?></p>
		
<p><input name="bp-activity-privacy" type="checkbox" id="bp-activity-privacy" value="1" <?php if (get_user_meta($bp->displayed_user->id, 'bp-activity-privacy',1) == '1') echo 'checked="checked"' ?> tabindex="99" /> <?php _e( 'only show activity to friends', 'bp-profile-privacy' ); ?></p>
		
<p><input name="bp-group-privacy" type="checkbox" id="bp-group-privacy" value="1" <?php if (get_user_meta($bp->displayed_user->id, 'bp-group-privacy',1) == '1') echo 'checked="checked"' ?> tabindex="99" /> <?php _e( 'only show groups to friends', 'bp-profile-privacy' ); ?></p>
			
<p><input name="bp-friend-privacy" type="checkbox" id="bp-friend-privacy" value="1" <?php if (get_user_meta($bp->displayed_user->id, 'bp-friend-privacy',1) == '1') echo 'checked="checked"' ?> tabindex="99" /> <?php _e( 'only show friend connections to friends', 'bp-profile-privacy' ); ?></p>	

<p><input name="bp-forum-privacy" type="checkbox" id="bp-forum-privacy" value="1" <?php if (get_user_meta($bp->displayed_user->id, 'bp-forum-privacy',1) == '1') echo 'checked="checked"' ?> tabindex="99" /> <?php _e( 'only show forum topics to friends', 'bp-profile-privacy' ); ?> </p>

<p><input type="submit" name="submit" id="submit" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" /></p>

</form>
<?php

} 
?>