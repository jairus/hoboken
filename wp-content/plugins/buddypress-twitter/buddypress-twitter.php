<?php

/* include the buddypress twitter admin extension */
require ( dirname( __FILE__ ) . '/admin.php' );

/* Only include the working extensions dependant on admin options ( 'members' and 'groups' ) */

/* only include the member extension if enabled */

	if ( !$twittercj_members_extension_check ) {
		if ( !$twittercj_members_extension_check = get_option('twittercj-members') )
			$twittercj_members_extension_check = ''; // the default
	}
	if ( $twittercj_members_extension_check == '1' ) {

require( dirname( __FILE__ ) . '/includes/twitter-members-extension.php' );
	}


/* only include the group extension if enabled */

	if ( !$twittercj_group_extension_check ) {
		if ( !$twittercj_group_extension_check = get_option('twittercj-groups') )
			$twittercj_group_extension_check = ''; // the default
	}
	if ( $twittercj_group_extension_check == '1' ) {



require( dirname( __FILE__ ) . '/includes/twitter-groups-extension.php' );
	}
?>