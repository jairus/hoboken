<?php

/**
 * BuddyPress - Groups Home
 *
 * @package BuddyPress
 * @subpackage BuddyBoss
 */
 
?>

<?php get_header(); ?>

<div id="column-one">

<div id="box">
		
			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

			<?php do_action( 'bp_before_group_home_content' ) ?>


				<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>


<!-- Hide group navigation from forums -->
<?php if ( bp_is_group_forum() && bp_group_is_visible() ) : ?>
<?php else : ?>

<div class="group-buttons">
<ul>								
<?php bp_get_options_nav() ?>
<?php if ( has_nav_menu( 'group-menu' ) ) : ?>
<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'group-menu', 'items_wrap' => '%3$' ) ); ?>
<?php endif; ?>
<?php do_action( 'bp_group_options_nav' ) ?>
</ul>
</div>
<?php endif; ?>


				<?php do_action( 'bp_before_group_body' );

				if ( bp_is_group_admin_page() && bp_group_is_visible() ) :
					locate_template( array( 'groups/single/admin.php' ), true );

				elseif ( bp_is_group_members() && bp_group_is_visible() ) :
					locate_template( array( 'groups/single/members.php' ), true );

				elseif ( bp_is_group_invites() && bp_group_is_visible() ) :
					locate_template( array( 'groups/single/send-invites.php' ), true );

					elseif ( bp_is_group_forum() && bp_group_is_visible() && bp_is_active( 'forums' ) && bp_forums_is_installed_correctly() ) : 
						locate_template( array( 'groups/single/forum.php' ), true );

				elseif ( bp_is_group_membership_request() ) :
					locate_template( array( 'groups/single/request-membership.php' ), true );

				elseif ( bp_group_is_visible() && bp_is_active( 'activity' ) ) :
					locate_template( array( 'groups/single/activity.php' ), true );

				elseif ( bp_group_is_visible() ) :
					locate_template( array( 'groups/single/members.php' ), true );

				elseif ( !bp_group_is_visible() ) :
					// The group is not visible, show the status message

					do_action( 'bp_before_group_status_message' ); ?>

<br clear="all" />
<div id="message" class="info">
<p><?php bp_group_status_message(); ?></p>
</div>

<?php do_action( 'bp_after_group_status_message' );

				else :
					// If nothing sticks, just load a group front template if one exists.
					locate_template( array( 'groups/single/front.php' ), true );

				endif;

				do_action( 'bp_after_group_body' ); ?>

			<?php do_action( 'bp_after_group_home_content' ) ?>

			<?php endwhile; endif; ?>

</div><!-- #box -->

</div><!-- #column-one -->

<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adsforums') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>

</div><!-- #column-two -->

<?php get_footer(); ?>