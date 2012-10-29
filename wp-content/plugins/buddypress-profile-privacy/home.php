<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php get_header( 'buddypress' ); ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ); ?>

			<div id="item-header" role="complementary">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body">

				<?php do_action( 'bp_before_member_body' );

				if ( bp_is_user_activity() || !bp_current_component() ) :
					if ( bp_activity_privacy_is_set()) : 
						 if ( bp_displayed_user_is_friend() ) : 
							   ?> <div id="not_friend_message">
							   <?php _e( 'You must be friends in order to access this users activity.', 'bp-profile-privacy' ) ?>
									
								</div>
								<?php
						endif; 
					else :	
					locate_template( array( 'members/single/activity.php' ), true );
					endif;

				 elseif ( bp_is_user_blogs() ) :
					locate_template( array( 'members/single/blogs.php'    ), true );

				elseif ( bp_is_user_friends() ) :
					if ( bp_friend_privacy_is_set()) : 
						 if ( bp_displayed_user_is_friend() ) : 
							   ?> <div id="not_friend_message">
							   <?php _e( 'You must be friends in order to access this users friends.', 'bp-profile-privacy' ) ?>
								</div>
								<?php
						endif; 
					else :
					locate_template( array( 'members/single/friends.php'  ), true );
					endif;

				elseif ( bp_is_user_groups() ) :
					if ( bp_group_privacy_is_set()) : 
						 if ( bp_displayed_user_is_friend() ) : 
							   ?> <div id="not_friend_message">
							   <?php _e( 'You must be friends in order to access this users groups.', 'bp-profile-privacy' ) ?>
									
								</div>
								<?php
						endif; 
					else :
					locate_template( array( 'members/single/groups.php'   ), true );
					endif;

				elseif ( bp_is_user_messages() ) :
					locate_template( array( 'members/single/messages.php' ), true );

				elseif ( bp_is_user_profile()) :
					if ( bp_profile_privacy_is_set()) : 
						 if ( bp_displayed_user_is_friend() ) : 
							   ?> <div id="not_friend_message">
							   <?php _e( 'You must be friends in order to access this users profile.', 'bp-profile-privacy' ) ?>
								</div>
								<?php
						endif; 
					else :	
					locate_template( array( 'members/single/profile.php'  ), true );
					endif;

				elseif ( bp_is_user_forums() ) :
					if ( bp_forum_privacy_is_set()) : 
						 if ( bp_displayed_user_is_friend() ) : 
							   ?> <div id="not_friend_message">
							   <?php _e( 'You must be friends in order to access this users forum topics.', 'bp-profile-privacy' ) ?>
								</div>
								<?php
						endif; 
					else :	
					locate_template( array( 'members/single/forums.php'  ), true );
					endif;

				// If nothing sticks, load a generic template
				else :
					locate_template( array( 'members/single/front.php'    ), true );

				endif;

				do_action( 'bp_after_member_body' ); ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
